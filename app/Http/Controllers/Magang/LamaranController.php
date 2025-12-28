<?php

namespace App\Http\Controllers\Magang;

use App\Http\Controllers\Controller;
use App\Models\Lamaran;
use App\Models\Lowongan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class LamaranController extends Controller
{
    function lamaran(Request $request, Lowongan $lowongan){
        if(Auth::user()->role !== 'pengguna'){
            abort(403);
        }

        $validator = Validator::make($request->all(), [
            'cv'                    => 'required|mimes:pdf|max:2048',
            'g-recaptcha-response'  => 'required'
        ], [
            'cv.required' => 'CV wajib diupload.',
            'cv.mimes'    => 'File harus berformat PDF.',
            'cv.max'      => 'Ukuran file maksimal 2 MB.',

            'g-recaptcha-response.required' => 'Captcha wajib diisi.'
        ]);

        if($validator->fails()) return redirect()->back()->withErrors($validator)->withInput();

        // captcha
        $secret = config('services.recaptcha.secret_key');

        $response = file_get_contents(
            "https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=" .
            $request->input('g-recaptcha-response')
        );

        $responseKeys = json_decode($response, true);

        if (! $responseKeys['success']) {
            return back()
                ->withInput()
                ->withErrors(['g-recaptcha-response' => 'Verifikasi captcha gagal. Coba lagi.']);
        }

        // simpan cv di local
        $cvPath = $request->file('cv')->store('cv', 'public');

        Lamaran::create([
            'id_lowongan'       => $lowongan->id,
            'id_pengguna'       => Auth::user()->id,
            'cv'                => $cvPath,
        ]);

        return redirect()->route('lowongan')->with('success', 'Anda Berhasil Melamar');
    }

    function lamar(){
        if(!in_array(Auth::user()->role, ['mitra' ,'pengguna'])){
            abort(403);
        }

        if(Auth::user()->role === 'pengguna'){
            $lamarans = Lamaran::with('pengguna', 'lowongan')->where('id_pengguna', Auth::user()->id)->paginate(5);

            return view('Lamaran.index', compact('lamarans'));
        }
        
        if(Auth::user()->role === 'mitra'){
            $lowonganId = Lowongan::where('id_mitra', Auth::user()->id)->pluck('id');
            $lamarans = Lamaran::with('pengguna', 'lowongan')->whereIn('id_lowongan', $lowonganId)->paginate(5);
            $lowongans = Lowongan::where('id_mitra', Auth::user()->id)->paginate(5);

            return view('Lamaran.index', compact('lamarans', 'lowongans'));
        }
    }

    public function lamarPreview(Lamaran $lamaran){
        if(!in_array(Auth::user()->role, ['mitra' ,'pengguna'])){
            abort(403);
        }

        if (! $lamaran->cv || ! Storage::disk('public')->exists($lamaran->cv)) {
            abort(404, 'CV tidak ditemukan.');
        }

        return response()->file(
            storage_path('app/public/'.$lamaran->cv)
        );
    }

    public function lamarEdit(Lamaran $lamaran){
        if(!in_array(Auth::user()->role, ['mitra' ,'pengguna'])){
            abort(403);
        }
        
        $lamaran->load([
            'pengguna',
            'lowongan.mitra',
            'lowongan.type',
            'lowongan.jenjang',
            'lowongan.keahlian',
        ]);

        return view('Lamaran.edit', compact('lamaran'));
    }

    public function lamarUpdate(Request $request, Lamaran $lamaran)
    {
        if(!in_array(Auth::user()->role, ['mitra' ,'pengguna'])){
            abort(403);
        }

        if(Auth::user()->role === 'pengguna'){

            // amankan: hanya lamaran milik user
            if ($lamaran->id_pengguna !== Auth::id()) {
                abort(403);
            }

            $request->validate([
                'cv' => 'required|mimes:pdf|max:2048',
            ]);

            if ($lamaran->cv) {
                Storage::disk('public')->delete($lamaran->cv);
            }

            $lamaran->update([
                'cv' => $request->file('cv')->store('cv', 'public'),
            ]);

            return redirect()->route('lamar')
                ->with('success', 'Data Lamaran Berhasil Diupdate');
        }

        if(Auth::user()->role === 'mitra'){

            $request->validate([
                'status' => 'required|in:pending,diterima,ditolak',
            ]);

            $lamaran->update([
                'status' => $request->status,
            ]);

            return redirect()->route('lamar')
                ->with('success', 'Data Lamaran Berhasil Diupdate');
        }
    }

    function lamarHapus($lamaran){
        if(!in_array(Auth::user()->role, ['mitra' ,'pengguna'])){
            abort(403);
        }

        $lamaran = Lamaran::findOrFail($lamaran);

        // hapus cv dari local
        if ($lamaran->cv && Storage::disk('public')->exists($lamaran->cv)) {
            Storage::disk('public')->delete($lamaran->cv);
        }

        if($lamaran){
            $lamaran->delete();
        }

        return redirect()->route('lamar')->with('success', 'Data Lamaran Berhasil Dihapus');
    }
}
