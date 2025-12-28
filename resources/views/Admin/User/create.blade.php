@extends('Layout.nav')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-28 pb-12">

    <!-- Header -->
    <div class="mb-8 border-b border-neutral-800 pb-6">
        <h1 class="text-3xl font-bold">Tambah User</h1>
        <p class="text-sm text-neutral-500">
            Tambahkan user baru ke dalam sistem
        </p>
    </div>

    <!-- FORM FULL WIDTH (SAMA DENGAN TABLE) -->
    <div class="glass p-8 w-full">
        <form action="{{ route('userStore') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6" enctype="multipart/form-data">
            @csrf

            <!-- FOTO (FULL ROW) -->
            <div class="md:col-span-2">
                <label class="block text-xs text-neutral-400 mb-1">
                    Foto Profil
                </label>

                <input
                    type="file"
                    name="foto"
                    accept="image/*"
                    class="w-full text-sm text-neutral-300
                        file:bg-neutral-800 file:border-0
                        file:px-4 file:py-2 file:rounded-lg
                        file:text-white file:cursor-pointer
                        hover:file:bg-neutral-700"
                >

                <p class="text-xs text-neutral-500 mt-1">
                    Format JPG / PNG · Maksimal 2MB
                </p>
                @error('foto')
                  <small>{{ $message }}</small>
                @enderror
            </div>

            <!-- Nama -->
            <div>
                <label class="block text-xs text-neutral-400 mb-1">Nama Lengkap</label>
                <input name="nama" required class="w-full bg-black/50 border border-neutral-800 rounded-lg px-3 py-2 text-sm text-white">
                @error('nama')
                    <small>{{ $message }}</small>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label class="block text-xs text-neutral-400 mb-1">Email</label>
                <input type="email" name="email" required class="w-full bg-black/50 border border-neutral-800 rounded-lg px-3 py-2 text-sm text-white">
                    @error('email')
                        <small>{{ $message }}</small>
                    @enderror
            </div>

            <!-- Tempat Lahir -->
            <div>
                <label class="block text-xs text-neutral-400 mb-1">Tempat Lahir</label>
                <input name="tmpl" required class="w-full bg-black/50 border border-neutral-800 rounded-lg px-3 py-2 text-sm text-white">
                @error('tmpl')
                    <small>{{ $message }}</small>
                @enderror
            </div>

            <!-- Tanggal Lahir -->
            <div>
                <label class="block text-xs text-neutral-400 mb-1">Tanggal Lahir</label>
                <input type="date" name="tgll" required class="w-full bg-black/50 border border-neutral-800 rounded-lg px-3 py-2 text-sm text-white">
                @error('tgll')
                    <small>{{ $message }}</small>
                @enderror
            </div>

            <!-- Jenis Kelamin -->
            <div>
                <label class="block text-xs text-neutral-400 mb-1">Jenis Kelamin</label>
                <select name="jk" required class="w-full bg-black/50 border border-neutral-800 rounded-lg px-3 py-2 text-sm text-white">
                    <option value="">-- Pilih --</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
                @error('jk')
                  <small>{{ $message }}</small>
                @enderror
            </div>

            <!-- Jenjang -->
            <div>
                <label class="block text-xs text-neutral-400 mb-1">Jenjang</label>
                <select name="jenjang" required class="w-full bg-black/50 border border-neutral-800 rounded-lg px-3 py-2 text-sm text-white">
                    <option value="">-- Pilih Jenjang --</option>
                    <option value="smk">SMK</option>
                    <option value="D3">D3</option>
                    <option value="S1/D4">S1/D4</option>
                </select>
                @error('jenjang')
                  <small>{{ $message }}</small>
                @enderror
            </div>

            <!-- Nomor Telepon -->
            <div>
                <label class="block text-xs text-neutral-400 mb-1">Nomor Telepon</label>
                <input name="no_tlp"class="w-full bg-black/50 border border-neutral-800 rounded-lg px-3 py-2 text-sm text-white">
                @error('no_tlp')
                    <small>{{ $message }}</small>
                @enderror
            </div>

            <!-- Role -->
            <div>
                <label class="block text-xs text-neutral-400 mb-1">Role</label>
                <select name="role" required class="w-full bg-black/50 border border-neutral-800 rounded-lg px-3 py-2 text-sm text-white">
                    <option value="">-- Pilih Role --</option>
                    <option value="admin">Admin</option>
                    <option value="mitra">Mitra</option>
                    <option value="pengguna">Pengguna</option>
                </select>
                @error('role')
                  <small>{{ $message }}</small>
                @enderror
            </div>

            <!-- Alamat (FULL ROW) -->
            <div class="md:col-span-2">
                <label class="block text-xs text-neutral-400 mb-1">Alamat</label>
                <textarea name="alamat" rows="3" class="w-full bg-black/50 border border-neutral-800 rounded-lg px-3 py-2 text-sm text-white"></textarea>
                @error('alamat')
                    <small>{{ $message }}</small>
                @enderror
            </div>

            <!-- Password (FULL ROW) -->
            <div class="md:col-span-2">
                <label class="block text-xs text-neutral-400 mb-1">Password</label>
                <input type="password" name="password" required class="w-full bg-black/50 border border-neutral-800 rounded-lg px-3 py-2 text-sm text-white">
                @error('password')
                    <small>{{ $message }}</small>
                @enderror
            </div>

            <!-- ACTION -->
            <div class="md:col-span-2 flex justify-end gap-3 pt-4">
                <a href="{{ route('user') }}" class="px-6 py-2 rounded-lg bg-neutral-700 hover:bg-neutral-600 font-semibold">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 font-semibold">
                    Simpan
                </button>
            </div>

        </form>
    </div>

</div>
@endsection
