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
        ], [
            // FOTO
            'foto.required' => 'Foto wajib diupload.',
            'foto.image'    => 'File harus berupa gambar.',
            'foto.mimes'    => 'Format foto harus jpg, jpeg, png, atau gif.',
            'foto.max'      => 'Ukuran foto maksimal 2 MB.',

            // NAMA
            'nama.required' => 'Nama tidak boleh kosong.',
            'nama.max'      => 'Nama maksimal 255 karakter.',

            // TEMPAT LAHIR
            'tmpl.required' => 'Tempat lahir wajib diisi.',

            // TANGGAL LAHIR
            'tgll.required' => 'Tanggal lahir wajib diisi.',
            'tgll.date'     => 'Format tanggal lahir tidak valid.',

            // JENIS KELAMIN
            'jk.required'   => 'Jenis kelamin wajib dipilih.',
            'jk.in'         => 'Jenis kelamin harus L atau P.',

            // JENJANG
            'jenjang.required' => 'Jenjang pendidikan wajib dipilih.',
            'jenjang.in'       => 'Jenjang harus SMK, S1/D4, atau D3.',

            // EMAIL
            'email.required' => 'Email wajib diisi.',
            'email.email'    => 'Format email tidak valid.',
            'email.unique'   => 'Email sudah digunakan.',

            // NOMOR TELEPON
            'no_tlp.required'        => 'Nomor telepon wajib diisi.',
            'no_tlp.digits_between'  => 'Nomor telepon harus 10–15 angka.',

            // ROLE
            'role.required' => 'Role wajib dipilih.',
            'role.in'       => 'Role tidak valid.',

            // ALAMAT
            'alamat.required' => 'Alamat wajib diisi.',
            'alamat.max'      => 'Alamat maksimal 255 karakter.',

            // PASSWORD
            'password.required' => 'Password wajib diisi.',
            'password.min'      => 'Password minimal 8 karakter.',
        ]);
        
        if($validator->fails()) return redirect()->back()->withErrors($validator)->withInput();
        
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

        return redirect()->route('user')->with('success','Data user berhasil ditambah');
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
        ], [
            // FOTO
            'foto.required' => 'Foto wajib diupload.',
            'foto.image'    => 'File harus berupa gambar.',
            'foto.mimes'    => 'Format foto harus jpg, jpeg, png, atau gif.',
            'foto.max'      => 'Ukuran foto maksimal 2 MB.',

            // NAMA
            'nama.required' => 'Nama tidak boleh kosong.',
            'nama.max'      => 'Nama maksimal 255 karakter.',

            // TEMPAT LAHIR
            'tmpl.required' => 'Tempat lahir wajib diisi.',

            // TANGGAL LAHIR
            'tgll.required' => 'Tanggal lahir wajib diisi.',
            'tgll.date'     => 'Format tanggal lahir tidak valid.',

            // JENIS KELAMIN
            'jk.required'   => 'Jenis kelamin wajib dipilih.',
            'jk.in'         => 'Jenis kelamin harus L atau P.',

            // JENJANG
            'jenjang.required' => 'Jenjang pendidikan wajib dipilih.',
            'jenjang.in'       => 'Jenjang harus SMK, S1/D4, atau D3.',

            // EMAIL
            'email.required' => 'Email wajib diisi.',
            'email.email'    => 'Format email tidak valid.',
            'email.unique'   => 'Email sudah digunakan.',

            // NOMOR TELEPON
            'no_tlp.required'        => 'Nomor telepon wajib diisi.',
            'no_tlp.digits_between'  => 'Nomor telepon harus 10–15 angka.',

            // ROLE
            'role.required' => 'Role wajib dipilih.',
            'role.in'       => 'Role tidak valid.',

            // ALAMAT
            'alamat.required' => 'Alamat wajib diisi.',
            'alamat.max'      => 'Alamat maksimal 255 karakter.',

            // PASSWORD
            'password.required' => 'Password wajib diisi.',
            'password.min'      => 'Password minimal 8 karakter.',
        ]);
        
        if($validator->fails()) return redirect()->back()->withErrors($validator)->withInput();
        
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

        return redirect()->route('user')->with('success','Data user berhasil diupdate');
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

        return redirect()->route('user')->with('success','Data user berhasil dihapus');
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

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255|unique:types,nama',
        ], [
            // messages
            'nama.required' => 'Nama type wajib diisi.',
            'nama.string'   => 'Nama type harus berupa teks.',
            'nama.max'      => 'Nama type maksimal 255 karakter.',
            'nama.unique'   => 'Nama type sudah ada, gunakan nama lain.',
        ]);

        if($validator->fails()) return redirect()->back()->withErrors($validator)->withInput();

        Type::create([
            'nama'  => $request->nama
        ]);

        return redirect()->route('type')->with('success', 'Data type berhasil ditambahkan');
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

        $validator = Validator::make($request->all(),[
            'nama' => 'required|string|max:100|unique:types,nama,' . $type->id,
        ], [
            // messages
            'nama.required' => 'Nama type wajib diisi.',
            'nama.string'   => 'Nama type harus berupa teks.',
            'nama.max'      => 'Nama type maksimal 255 karakter.',
            'nama.unique'   => 'Nama type sudah ada, gunakan nama lain.',
        ]);

        if($validator->fails()) return redirect()->back()->withErrors($validator)->withInput();

        $type->update([
            'nama' => $request->nama,
        ]);

        return redirect()->route('type')->with('success', 'Type berhasil diperbarui');
    }


    function typeHapus($type){
        if(Auth::user()->role !== 'admin'){
            abort(403);
        }

        $type = Type::findOrFail($type);

        if($type){
            $type->delete();
        }

        return redirect()->route('type')->with('success', 'Data type berhasil dihapus');
    }

    // fungsi halaman admin jenjang
    function jenjang(){
        if(Auth::user()->role !== 'admin'){
            abort(403);
        }

        $jenjangs = Jenjang::paginate(5);
        return view('Admin.Jenjang.index', compact('jenjangs'));
    }

    function jenjangTambah(){
        if(Auth::user()->role !== 'admin'){
            abort(403);
        }

        return view('Admin.Jenjang.create');
    }

    function jenjangStore(Request $request){
        if(Auth::user()->role !== 'admin'){
            abort(403);
        }

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255|unique:jenjangs,nama',
        ], [
            // messages
            'nama.required' => 'Nama jenjang wajib diisi.',
            'nama.string'   => 'Nama jenjang harus berupa teks.',
            'nama.max'      => 'Nama jenjang maksimal 255 karakter.',
            'nama.unique'   => 'Nama jenjang sudah ada, gunakan nama lain.',
        ]);

        if($validator->fails()) return redirect()->back()->withErrors($validator)->withInput();

        Jenjang::create([
            'nama'  => $request->nama
        ]);

        return redirect()->route('jenjang')->with('success', 'Data jenjang berhasil ditambahkan');
    }

    public function jenjangEdit(Jenjang $jenjang){
        if(Auth::user()->role !== 'admin'){
            abort(403);
        }

        return view('Admin.Jenjang.edit', compact('jenjang'));
    }


    public function jenjangUpdate(Request $request, Jenjang $jenjang){
        if(Auth::user()->role !== 'admin'){
            abort(403);
        }

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:100|unique:jenjangs,nama,' . $jenjang->id,
        ], [
            // messages
            'nama.required' => 'Nama jenjang wajib diisi.',
            'nama.string'   => 'Nama jenjang harus berupa teks.',
            'nama.max'      => 'Nama jenjang maksimal 255 karakter.',
            'nama.unique'   => 'Nama jenjang sudah ada, gunakan nama lain.',
        ]);

        if($validator->fails()) return redirect()->back()->withErrors($validator)->withInput();

        $jenjang->update([
            'nama' => $request->nama,
        ]);

        return redirect()->route('jenjang')->with('success', 'Jenjang berhasil diperbarui');
    }


    function jenjangHapus($jenjang){
        if(Auth::user()->role !== 'admin'){
            abort(403);
        }

        $jenjang = Jenjang::findOrFail($jenjang);

        if($jenjang){
            $jenjang->delete();
        }

        return redirect()->route('jenjang')->with('success', 'Data jenjang berhasil dihapus');
    }

    // fungsi halaman admin keahlian
    function keahlian(){
        if(Auth::user()->role !== 'admin'){
            abort(403);
        }

        $keahlians = Keahlian::paginate(5);
        return view('Admin.Keahlian.index', compact('keahlians'));
    }

    function keahlianTambah(){
        if(Auth::user()->role !== 'admin'){
            abort(403);
        }

        return view('Admin.Keahlian.create');
    }

    function keahlianStore(Request $request){
        if(Auth::user()->role !== 'admin'){
            abort(403);
        }

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255|unique:keahlians,nama',
        ], [
            // messages
            'nama.required' => 'Nama keahlian wajib diisi.',
            'nama.string'   => 'Nama keahlian harus berupa teks.',
            'nama.max'      => 'Nama keahlian maksimal 255 karakter.',
            'nama.unique'   => 'Nama keahlian sudah ada, gunakan nama lain.',
        ]);

        if($validator->fails()) return redirect()->back()->withErrors($validator)->withInput();

        Keahlian::create([
            'nama'  => $request->nama
        ]);

        return redirect()->route('keahlian')->with('success', 'Data keahlian berhasil ditambahkan');
    }

    public function keahlianEdit(Keahlian $keahlian){
        if(Auth::user()->role !== 'admin'){
            abort(403);
        }

        return view('Admin.Keahlian.edit', compact('keahlian'));
    }


    public function keahlianUpdate(Request $request, Keahlian $keahlian){
        if(Auth::user()->role !== 'admin'){
            abort(403);
        }

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:100|unique:keahlians,nama,' . $keahlian->id,
        ], [
            // messages
            'nama.required' => 'Nama keahlian wajib diisi.',
            'nama.string'   => 'Nama keahlian harus berupa teks.',
            'nama.max'      => 'Nama keahlian maksimal 255 karakter.',
            'nama.unique'   => 'Nama keahlian sudah ada, gunakan nama lain.',
        ]);

        if($validator->fails()) return redirect()->back()->withErrors($validator)->withInput();

        $keahlian->update([
            'nama' => $request->nama,
        ]);

        return redirect()->route('keahlian')->with('success', 'Keahlian berhasil diperbarui');
    }


    function keahlianHapus($keahlian){
        if(Auth::user()->role !== 'admin'){
            abort(403);
        }

        $keahlian = Keahlian::findOrFail($keahlian);

        if($keahlian){
            $keahlian->delete();
        }

        return redirect()->route('keahlian')->with('success', 'Data keahlian berhasil dihapus');
    }
}
