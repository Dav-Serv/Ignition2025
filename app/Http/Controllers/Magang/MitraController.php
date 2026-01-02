<?php

namespace App\Http\Controllers\Magang;

use App\Http\Controllers\Controller;
use App\Models\Jenjang;
use App\Models\Keahlian;
use App\Models\Lowongan;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MitraController extends Controller
{
    function mitra(){
        if(Auth::user()->role !== 'mitra'){
            abort(403);
        }

        if(Auth::user()->role == 'mitra'){
            $mitras = Lowongan::with('mitra', 'type', 'jenjang', 'keahlian')->where('id_mitra', Auth::user()->id)->paginate(5);
        }

        return view('Mitra.index', compact('mitras'));
    }

    function mitraTambah(){
        if(Auth::user()->role !== 'mitra'){
            abort(403);
        }

        $types = Type::get();
        $jenjangs = Jenjang::get();
        $keahlians = Keahlian::get();

        return view('Mitra.create', compact('types', 'jenjangs', 'keahlians'));
    }

    function mitraStore(Request $request){
        if(Auth::user()->role !== 'mitra'){
            abort(403);
        }

        $validator = Validator::make($request->all(), [
            'type'          => 'required|exists:types,id',
            'jenjang'       => 'required|exists:jenjangs,id',
            'keahlian'      => 'required|exists:keahlians,id',
            'job'           => 'required|string|max:255',
            'keterangan'    => 'required|max:255',
        ]);

        if($validator->fails()) return redirect()->back()->withErrors($validator)->withInput();

        Lowongan::create([
            'id_mitra'      => Auth::user()->id,
            'id_type'       => $request->type,
            'id_jenjang'    => $request->jenjang,
            'id_keahlian'   => $request->keahlian,
            'job'           => $request->job,
            'keterangan'    => $request->keterangan
        ]);

        return redirect()->route('mitra')->with('success','Data Lowongan Berhasil Ditambah');
    }

    function mitraEdit(Lowongan $mitra){
        if(Auth::user()->role !== 'mitra'){
            abort(403);
        }

        $types = Type::get();
        $jenjangs = Jenjang::get();
        $keahlians = Keahlian::get();

        return view('Mitra.edit', compact('mitra', 'types', 'jenjangs', 'keahlians'));
    }

    function mitraUpdate(Lowongan $mitra, Request $request){
        if(Auth::user()->role !== 'mitra'){
            abort(403);
        }

        $validator = Validator::make($request->all(), [
            'type'          => 'required|exists:types,id',
            'jenjang'       => 'required|exists:jenjangs,id',
            'keahlian'      => 'required|exists:keahlians,id',
            'job'           => 'required|string|max:255',
            'keterangan'    => 'required|max:255',
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data = [
            'id_type'       => $request->type,
            'id_jenjang'    => $request->jenjang,
            'id_keahlian'   => $request->keahlian,
            'job'           => $request->job,
            'keterangan'    => $request->keterangan
        ];

        $mitra->update($data);

        return redirect()->route('mitra')->with('success', 'Data Lowongan Berhasil Diupdate');
    }

    function mitraHapus($mitra){
        if(Auth::user()->role !== 'mitra'){
            abort(403);
        }

        $mitra = Lowongan::findOrFail($mitra);

        if($mitra){
            $mitra->delete();
        }

        return redirect()->route('mitra')->with('success', 'Data Lowongan Berhasil Dihapus');
    }
}
