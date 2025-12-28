@extends('Layout.nav')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-28 pb-12">

    <!-- Header -->
    <div class="mb-8 border-b border-neutral-800 pb-6">
        <h1 class="text-3xl font-bold">Edit User</h1>
        <p class="text-sm text-neutral-500">
            Perbarui data user
        </p>
    </div>

    <!-- FORM -->
    <div class="glass p-8 w-full">
        <form action="{{ route('userUpdate', $user->id) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @csrf
            @method('PUT')

            <!-- FOTO -->
            <div class="md:col-span-2">
                <label class="block text-xs text-neutral-400 mb-1">Foto Profil</label>

                @if($user->foto)
                    <img src="{{ asset('storage/'.$user->foto) }}"
                         class="w-16 h-16 rounded-full object-cover mb-3 border border-white/10">
                @endif

                <input type="file" name="foto" accept="image/*"
                       class="w-full text-sm text-neutral-300
                              file:bg-neutral-800 file:border-0
                              file:px-4 file:py-2 file:rounded-lg
                              file:text-white file:cursor-pointer
                              hover:file:bg-neutral-700">

                @error('foto')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <!-- Nama -->
            <div>
                <label class="block text-xs text-neutral-400 mb-1">Nama Lengkap</label>
                <input name="nama" value="{{ old('nama', $user->nama) }}" required class="w-full bg-black/50 border border-neutral-800 rounded-lg px-3 py-2 text-sm text-white">
                @error('nama') 
                    <small class="text-red-500">{{ $message }}</small> 
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label class="block text-xs text-neutral-400 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full bg-black/50 border border-neutral-800 rounded-lg px-3 py-2 text-sm text-white">
                @error('email') 
                    <small class="text-red-500">{{ $message }}</small> 
                @enderror
            </div>

            <!-- Tempat Lahir -->
            <div>
                <label class="block text-xs text-neutral-400 mb-1">Tempat Lahir</label>
                <input name="tmpl" value="{{ old('tmpl', $user->tempat_lahir) }}" required class="w-full bg-black/50 border border-neutral-800 rounded-lg px-3 py-2 text-sm text-white">
                @error('tmpl') 
                    <small class="text-red-500">{{ $message }}</small> 
                @enderror
            </div>

            <!-- Tanggal Lahir -->
            <div>
                <label class="block text-xs text-neutral-400 mb-1">Tanggal Lahir</label>
                <input type="date" name="tgll" value="{{ old('tgll', $user->tanggal_lahir) }}" required class="w-full bg-black/50 border border-neutral-800 rounded-lg px-3 py-2 text-sm text-white">
                @error('tgll') 
                    <small class="text-red-500">{{ $message }}</small> 
                @enderror
            </div>

            <!-- Jenis Kelamin -->
            <div>
                <label class="block text-xs text-neutral-400 mb-1">Jenis Kelamin</label>
                <select name="jk" required
                        class="w-full bg-black/50 border border-neutral-800 rounded-lg px-3 py-2 text-sm text-white">
                    <option value="L" {{ old('jk', $user->jk) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ old('jk', $user->jk) == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
                @error('jk') 
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <!-- Jenjang -->
            <div>
                <label class="block text-xs text-neutral-400 mb-1">Jenjang</label>
                <select name="jenjang" required
                        class="w-full bg-black/50 border border-neutral-800 rounded-lg px-3 py-2 text-sm text-white">
                    @foreach(['smk', 'S1/D4', 'D3'] as $j)
                        <option value="{{ $j }}"
                            {{ old('jenjang', $user->jenjang) == $j ? 'selected' : '' }}>
                            {{ $j }}
                        </option>
                    @endforeach
                </select>
                @error('jenjang') 
                    <small class="text-red-500">{{ $message }}</small> 
                @enderror
            </div>

            <!-- Nomor Telepon -->
            <div>
                <label class="block text-xs text-neutral-400 mb-1">Nomor Telepon</label>
                <input name="no_tlp" value="{{ old('no_tlp', $user->no_tlp) }}"
                       class="w-full bg-black/50 border border-neutral-800 rounded-lg px-3 py-2 text-sm text-white">
                @error('no_tlp') 
                    <small class="text-red-500">{{ $message }}</small> 
                @enderror
            </div>

            <!-- Role -->
            <div>
                <label class="block text-xs text-neutral-400 mb-1">Role</label>
                <select name="role" required
                        class="w-full bg-black/50 border border-neutral-800 rounded-lg px-3 py-2 text-sm text-white">
                    @foreach(['admin','mitra','pengguna'] as $r)
                        <option value="{{ $r }}"
                            {{ old('role', $user->role) == $r ? 'selected' : '' }}>
                            {{ ucfirst($r) }}
                        </option>
                    @endforeach
                </select>
                @error('role') 
                    <small class="text-red-500">{{ $message }}</small> 
                @enderror
            </div>

            <!-- Alamat -->
            <div class="md:col-span-2">
                <label class="block text-xs text-neutral-400 mb-1">Alamat</label>
                <textarea name="alamat" rows="3"
                          class="w-full bg-black/50 border border-neutral-800 rounded-lg px-3 py-2 text-sm text-white">{{ old('alamat', $user->alamat) }}</textarea>
                @error('alamat') 
                    <small class="text-red-500">{{ $message }}</small> 
                @enderror
            </div>

            <!-- Password -->
            <div class="md:col-span-2">
                <label class="block text-xs text-neutral-400 mb-1">Password (opsional)</label>
                <input type="password" name="password"
                       class="w-full bg-black/50 border border-neutral-800 rounded-lg px-3 py-2 text-sm text-white">
                <small class="text-neutral-500">Kosongkan jika tidak ingin mengganti</small>
                @error('password') 
                    <small class="text-red-500">{{ $message }}</small> 
                @enderror
            </div>

            <!-- ACTION -->
            <div class="md:col-span-2 flex justify-end gap-3 pt-4">
                <a href="{{ route('user') }}"
                   class="px-6 py-2 rounded-lg bg-neutral-700 hover:bg-neutral-600 font-semibold">
                    Batal
                </a>
                <button type="submit"
                        class="px-6 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 font-semibold">
                    Update
                </button>
            </div>

        </form>
    </div>

</div>
@endsection
