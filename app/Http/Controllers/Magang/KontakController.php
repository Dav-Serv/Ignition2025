<?php

namespace App\Http\Controllers\Magang;

use App\Http\Controllers\Controller;
use App\Models\Kontak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class KontakController extends Controller
{
    function kontak(){
        if(Auth::user()->role !== 'admin'){
            abort(403);
        }

        $kontaks = Kontak::paginate(5);

        return view('Admin.Kontak.index', compact('kontaks'));
    }

    function kontakStore(Request $request){
        $validator = Validator::make($request->all(), [
            'nama'                  => 'required|string|max:255',
            'email'                 => 'required|email',
            'no_tlp'                => 'required|digits_between:10,15',
            'keperluan'             => 'required|max:255',
            'g-recaptcha-response'  => 'required'
        ], [
            // NAMA
            'nama.required'         => 'Nama wajib diisi.',
            'nama.max'              => 'Nama maksimal 255 karakter.',

            // EMAIL
            'email.required'        => 'Email wajib diisi.',
            'email.email'           => 'Format email tidak valid.',

            // TELEPON
            'no_tlp.required'       => 'Nomor telepon wajib diisi.',
            'no_tlp.digits_between' => 'Nomor telepon harus 10-15 digit angka.',

            // TELEPON
            'keperluan.required'        => 'keperluan wajib diisi.',

            // RECAPTCHA
            'g-recaptcha-response.required' => 'Captcha wajib diisi.'
        ]);

        if($validator->fails()) return redirect()->back()->withErrors($validator)->withInput();

        // captcha
        $secret = config('services.recaptcha.secret_key');

        $response = file_get_contents(
            "https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=" . $request->input('g-recaptcha-response')
        );

        $responseKeys = json_decode($response, true);

        if (! $responseKeys['success']) {
            return back()
                ->withInput()
                ->withErrors(['g-recaptcha-response' => 'Verifikasi captcha gagal. Coba lagi.']);
        }

        Kontak::create([
            'nama'          => $request->nama,
            'email'         => $request->email,
            'no_tlp'        => $request->no_tlp,
            'keperluan'     => $request->keperluan
        ]);

        return redirect()->route('dashboard')->with('success', 'Pesan anda berhasil terkirim, silahkan tunggu feedback dari admin');
    }

    function kontakShow(Kontak $kontak){
        return view('Admin.Kontak.show', compact('kontak'));
    }

    function kontakUpdate(Kontak $kontak){
        $kontak->update([
            'respon'    => 'dibaca'
        ]);

        return redirect()->route('kontak')->with('success', 'Pesan berhasil dibaca');
    }

    function kontakHapus($kontak){
        $kontak = Kontak::findOrFail($kontak);

        if($kontak){
            $kontak->delete();
        }

        return redirect()->route('kontak')->with('success', 'Pesan berhasil dihapus');
    }
}
