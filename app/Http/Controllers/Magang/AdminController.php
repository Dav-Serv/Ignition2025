<?php

namespace App\Http\Controllers\Magang;

use App\Http\Controllers\Controller;
use App\Models\Jenjang;
use App\Models\Keahlian;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    // fungsi halaman admin user
    function user(){
        if(Auth::user()->role !== 'admin'){
            abort(403);
        }

        $users = User::paginate(5);
        return view('Admin.User.index', compact('users'));
    }

    function userTambah(){
        if(Auth::user()->role !== 'admin'){
            abort(403);
        }

        return view('Admin.User.create');
    }

    function userStore(Request $request){
        if(Auth::user()->role !== 'admin'){
            abort(403);
        }

        $validator = Validator::make($request->all(),[
            'foto'                => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
            'nama'                => 'required|string|max:255',
            'tmpl'                => 'required|string|max:100',
            'tgll'                => 'required|date',
            'jk'                  => 'required|in:L,P',
            'jenjang'             => 'required|in:smk,S1/D4,D3',
            'email'               => 'required|email|unique:users,email',
            'no_tlp'              => 'required|digits_between:10,15',
            'role'                => 'required|in:admin,mitra,pengguna',
            'alamat'              => 'required|max:255',
            'password'            => 'required|min:8',
        ]);
        
        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);
        
        if ($request->hasFile('foto')) {
            $imagePath = $request->file('foto')->store('users', 'public');
        }

        User::create([
            'foto'          => $imagePath,
            'nama'          => $request->nama,
            'email'         => $request->email,
            'tempat_lahir'  => $request->tmpl,
            'tanggal_lahir' => $request->tgll,
            'jk'            => $request->jk,
            'jenjang'       => $request->jenjang,
            'no_tlp'        => $request->no_tlp,
            'role'          => $request->role,
            'alamat'        => $request->alamat,
            'password'      => Hash::make($request->password)
        ]);

        return redirect()->route('user')->with('success','Data User Berhasil Ditambah');
    }

    function userEdit(User $user){
        if(Auth::user()->role !== 'admin'){
            abort(403);
        }

        return view('Admin.User.edit', compact('user'));
    }

    function userUpdate(Request $request, User $user){
        if(Auth::user()->role !== 'admin'){
            abort(403);
        }

        $validator = Validator::make($request->all(),[
            'foto'                => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'nama'                => 'required|string|max:255',
            'tmpl'                => 'required|string|max:100',
            'tgll'                => 'required|date',
            'jk'                  => 'required|in:L,P',
            'jenjang'             => 'required|in:smk,S1/D4,D3',
            'email'               => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'no_tlp'              => 'required|digits_between:10,15',
            'role'                => 'required|in:admin,mitra,pengguna',
            'alamat'              => 'required|max:255',
            'password'            => 'nullable|min:8',
        ]);
        
        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);
        
        $data = [
            'nama'          => $request->nama,
            'email'         => $request->email,
            'tempat_lahir'  => $request->tmpl,
            'tanggal_lahir' => $request->tgll,
            'jk'            => $request->jk,
            'jenjang'       => $request->jenjang,
            'no_tlp'        => $request->no_tlp,
            'role'          => $request->role,
            'alamat'        => $request->alamat,
        ];

        // jika ada requestan password
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // Jika ada file foto baru diupload
        if ($request->hasFile('foto')) {
            if ($user->foto) {
                Storage::disk('public')->delete($user->foto);
            }

            $data['foto'] = $request->file('foto')->store('users', 'public');
        }

        // update data user
        $user->update($data);

        return redirect()->route('user')->with('success','Data User Berhasil Diupdate');
    }

    function userHapus($user){
        if(Auth::user()->role !== 'admin'){
            abort(403);
        }

        $user = User::findOrFail($user);

        //hapus foto dari local
        if ($user->foto && Storage::disk('public')->exists($user->foto)) {
            Storage::disk('public')->delete($user->foto);
        }

        if($user){
            $user->delete();
        }

        return redirect()->route('user')->with('success','Data User Berhasil Dihapus');
    }

    // fungsi halaman admin type
    function type(){
        if(Auth::user()->role !== 'admin'){
            abort(403);
        }

        $types = Type::paginate(5);
        return view('Admin.Type.index', compact('types'));
    }

    function typeTambah(){
        if(Auth::user()->role !== 'admin'){
            abort(403);
        }

        return view('Admin.Type.create');
    }

    function typeStore(Request $request){
        if(Auth::user()->role !== 'admin'){
            abort(403);
        }

        $validator = Validator::make($request->all(),[
            'nama'  => 'required|string|max:255'
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        Type::create([
            'nama'  => $request->nama
        ]);

        return redirect()->route('type')->with('success', 'Data Type Berhasil Ditambahkan');
    }

    public function typeEdit(Type $type){
        if(Auth::user()->role !== 'admin'){
            abort(403);
        }

        return view('Admin.Type.edit', compact('type'));
    }


    public function typeUpdate(Request $request, Type $type){
        if(Auth::user()->role !== 'admin'){
            abort(403);
        }

        $request->validate([
            'nama' => 'required|string|max:100|unique:types,nama,' . $type->id,
        ]);

        $type->update([
            'nama' => $request->nama,
        ]);

        return redirect()->route('type')->with('success', 'Type Berhasil Diperbarui');
    }


    function typeHapus($type){
        if(Auth::user()->role !== 'admin'){
            abort(403);
        }

        $type = Type::findOrFail($type);

        if($type){
            $type->delete();
        }

        return redirect()->route('type')->with('success', 'Data Type Berhasil Dihapus');
    }

    // fungsi halaman admin jenjang
    function jenjang(){
        if(Auth::user()->role !== 'admin'){
            abort(403);
        }

        $jenjangs = Jenjang::paginate(5);
        return view('Admin.jenjang.index', compact('jenjangs'));
    }

    function jenjangTambah(){
        if(Auth::user()->role !== 'admin'){
            abort(403);
        }

        return view('Admin.jenjang.create');
    }

    function jenjangStore(Request $request){
        if(Auth::user()->role !== 'admin'){
            abort(403);
        }

        $validator = Validator::make($request->all(),[
            'nama'  => 'required|string|max:255'
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        Jenjang::create([
            'nama'  => $request->nama
        ]);

        return redirect()->route('jenjang')->with('success', 'Data Jenjang Berhasil Ditambahkan');
    }

    public function jenjangEdit(Jenjang $jenjang){
        if(Auth::user()->role !== 'admin'){
            abort(403);
        }

        return view('Admin.jenjang.edit', compact('jenjang'));
    }


    public function jenjangUpdate(Request $request, Jenjang $jenjang){
        if(Auth::user()->role !== 'admin'){
            abort(403);
        }

        $request->validate([
            'nama' => 'required|string|max:100|unique:jenjangs,nama,' . $jenjang->id,
        ]);

        $jenjang->update([
            'nama' => $request->nama,
        ]);

        return redirect()->route('jenjang')->with('success', 'Jenjang Berhasil Diperbarui');
    }


    function jenjangHapus($jenjang){
        if(Auth::user()->role !== 'admin'){
            abort(403);
        }

        $jenjang = Jenjang::findOrFail($jenjang);

        if($jenjang){
            $jenjang->delete();
        }

        return redirect()->route('jenjang')->with('success', 'Data Jenjang Berhasil Dihapus');
    }

    // fungsi halaman admin keahlian
    function keahlian(){
        if(Auth::user()->role !== 'admin'){
            abort(403);
        }

        $keahlians = Keahlian::paginate(5);
        return view('Admin.keahlian.index', compact('keahlians'));
    }

    function keahlianTambah(){
        if(Auth::user()->role !== 'admin'){
            abort(403);
        }

        return view('Admin.keahlian.create');
    }

    function keahlianStore(Request $request){
        if(Auth::user()->role !== 'admin'){
            abort(403);
        }

        $validator = Validator::make($request->all(),[
            'nama'  => 'required|string|max:255'
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        Keahlian::create([
            'nama'  => $request->nama
        ]);

        return redirect()->route('keahlian')->with('success', 'Data Keahlian Berhasil Ditambahkan');
    }

    public function keahlianEdit(Keahlian $keahlian){
        if(Auth::user()->role !== 'admin'){
            abort(403);
        }

        return view('Admin.keahlian.edit', compact('keahlian'));
    }


    public function keahlianUpdate(Request $request, Keahlian $keahlian){
        if(Auth::user()->role !== 'admin'){
            abort(403);
        }

        $request->validate([
            'nama' => 'required|string|max:100|unique:keahlians,nama,' . $keahlian->id,
        ]);

        $keahlian->update([
            'nama' => $request->nama,
        ]);

        return redirect()->route('keahlian')->with('success', 'Keahlian Berhasil Diperbarui');
    }


    function keahlianHapus($keahlian){
        if(Auth::user()->role !== 'admin'){
            abort(403);
        }

        $keahlian = Keahlian::findOrFail($keahlian);

        if($keahlian){
            $keahlian->delete();
        }

        return redirect()->route('keahlian')->with('success', 'Data Keahlian Berhasil Dihapus');
    }
}
