<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function index(){
        return view('Auth.Register');
    }

    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'nama'          => 'required|string|max:255',
            'jk'            => 'required|in:L,P',
            'tmpl'          => 'required|string|max:100',
            'tgll'          => 'required|date',
            'jenjang'       => 'required|in:smk,S1/D4,D3',
            'alamat'        => 'required|max:255',
            'no_tlp'        => 'required|digits_between:10,15',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'email'         => 'required|email|unique:users,email',
            'password'      => 'required|min:8'
        ], [
            // NAMA
            'nama.required' => 'Nama wajib diisi.',
            'nama.max'      => 'Nama maksimal 255 karakter.',

            // JK
            'jk.required' => 'Jenis kelamin wajib dipilih.',
            'jk.in'       => 'Jenis kelamin tidak valid.',

            // TEMPAT / TANGGAL LAHIR
            'tmpl.required' => 'Tempat lahir wajib diisi.',
            'tmpl.max'      => 'Tempat lahir maksimal 100 karakter.',

            'tgll.required' => 'Tanggal lahir wajib diisi.',
            'tgll.date'     => 'Tanggal lahir tidak valid.',

            // JENJANG
            'jenjang.required' => 'Jenjang pendidikan wajib dipilih.',
            'jenjang.in'       => 'Pilihan jenjang tidak valid.',

            // ALAMAT
            'alamat.required' => 'Alamat wajib diisi.',
            'alamat.max'      => 'Alamat maksimal 255 karakter.',

            // TELEPON
            'no_tlp.required'       => 'Nomor telepon wajib diisi.',
            'no_tlp.digits_between' => 'Nomor telepon harus 10-15 digit angka.',

            // FOTO
            'foto.image' => 'File foto harus berupa gambar.',
            'foto.mimes' => 'Format foto harus JPG, JPEG, PNG, atau GIF.',
            'foto.max'   => 'Ukuran foto maksimal 2 MB.',

            // EMAIL
            'email.required' => 'Email wajib diisi.',
            'email.email'    => 'Format email tidak valid.',
            'email.unique'   => 'Email sudah terdaftar.',

            // PASSWORD
            'password.required' => 'Password wajib diisi.',
            'password.min'      => 'Password minimal 8 karakter.',
        ]);

        if($validator->fails()) return redirect()->back()->withErrors($validator)->withInput();

        if ($request->hasFile('foto')) {
            $imagePath = $request->file('foto')->store('users', 'public');
        }
        
        User::create([
            'nama'          => $request->nama,
            'jk'            => $request->jk,
            'tempat_lahir'  => $request->tmpl,
            'tanggal_lahir' => $request->tgll   ,
            'jenjang'       => $request->jenjang,
            'alamat'        => $request->alamat,
            'no_tlp'        => $request->no_tlp,
            'foto'          => $imagePath,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'role'        => 'admin'
        ]);

        $login =[
            'email'     => $request->email,
            'password'  => $request->password,
        ];

        if(Auth::attempt($login)){
            $request->session()->regenerate();
            return redirect()->route('dashboard')->with('success', 'Kamu Berhasil Mendaftar Dan Login');
        }
    }
}
