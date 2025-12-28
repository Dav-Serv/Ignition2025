@extends('Layout.nav')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-28 pb-12">

    <!-- Header -->
    <div class="mb-8 border-b border-neutral-800 pb-6">
        <h1 class="text-3xl font-bold">Edit Lamaran</h1>
        <p class="text-sm text-neutral-500">
            Perbarui data lamaran
        </p>
    </div>

    <!-- FORM FULL WIDTH (SAMA DENGAN TABLE) -->
    <div class="glass p-10 w-full">
        <form action="{{ route('lamarUpdate', $lamaran->id) }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Mitra -->
            @if(Auth::user()->role === 'mitra')
            <!-- nama (FULL ROW) -->
            <div class="md:col-span-10">
                <label class="block text-xs text-neutral-400 mb-1">Nama</label>
                <input value="{{ old('nama', $lamaran->pengguna?->nama) }}" type="text" name="nama" required class="w-full bg-black/50 border border-neutral-800 rounded-lg px-3 py-2 text-sm text-white disabled:bg-neutral-800 disabled:text-neutral-400 disabled:border-neutral-700 disabled:cursor-not-allowed" disabled>
                @error('nama')
                    <small>{{ $message }}</small>
                @enderror
            </div>

            <!-- jk -->
            <div class="md:col-span-10">
                <label class="block text-xs text-neutral-400 mb-1">Jenis Kelamin</label>
                <select disabled disabled name="jk" required class="w-full bg-black/50 border border-neutral-800 rounded-lg px-3 py-2 text-sm text-white disabled:bg-neutral-800 disabled:text-neutral-400 disabled:border-neutral-700 disabled:cursor-not-allowed">
                    <option disabled selected value="">-- Pilih Jenis Kelamin --</option>
                    <option value="L" {{ old('jk', $lamaran->pengguna?->jk) == 'L' ? 'selected' : '' }}>Laki-Laki</option>
                    <option value="P" {{ old('jk', $lamaran->pengguna?->jk) == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
                @error('jk')
                  <small>{{ $message }}</small>
                @enderror
            </div>

            <!-- email (FULL ROW) -->
            <div class="md:col-span-10">
                <label class="block text-xs text-neutral-400 mb-1">Email</label>
                <input value="{{ old('email', $lamaran->pengguna?->email) }}" type="text" name="email" required class="w-full bg-black/50 border border-neutral-800 rounded-lg px-3 py-2 text-sm text-white disabled:bg-neutral-800 disabled:text-neutral-400 disabled:border-neutral-700 disabled:cursor-not-allowed" disabled>
                @error('email')
                    <small>{{ $message }}</small>
                @enderror
            </div>

            <!-- telephone (FULL ROW) -->
            <div class="md:col-span-10">
                <label class="block text-xs text-neutral-400 mb-1">Telephone</label>
                <input value="{{ old('telephone', $lamaran->pengguna?->no_tlp) }}" type="text" name="telephone" required class="w-full bg-black/50 border border-neutral-800 rounded-lg px-3 py-2 text-sm text-white disabled:bg-neutral-800 disabled:text-neutral-400 disabled:border-neutral-700 disabled:cursor-not-allowed" disabled>
                @error('telephone')
                    <small>{{ $message }}</small>
                @enderror
            </div>

            <!-- alamat (FULL ROW) -->
            <div class="md:col-span-10">
                <label class="block text-xs text-neutral-400 mb-1">Alamat</label>
                <input value="{{ old('alamat', $lamaran->pengguna?->alamat) }}" type="text" name="alamat" required class="w-full bg-black/50 border border-neutral-800 rounded-lg px-3 py-2 text-sm text-white disabled:bg-neutral-800 disabled:text-neutral-400 disabled:border-neutral-700 disabled:cursor-not-allowed" disabled>
                @error('alamat')
                    <small>{{ $message }}</small>
                @enderror
            </div>

            <!-- Job (FULL ROW) -->
            <div class="md:col-span-10">
                <label class="block text-xs text-neutral-400 mb-1">Job</label>
                <input value="{{ old('job', $lamaran->lowongan?->job) }}" type="text" name="job" required class="w-full bg-black/50 border border-neutral-800 rounded-lg px-3 py-2 text-sm text-white disabled:bg-neutral-800 disabled:text-neutral-400 disabled:border-neutral-700 disabled:cursor-not-allowed" disabled>
                @error('job')
                    <small>{{ $message }}</small>
                @enderror
            </div>

            <!-- Type -->
            <div class="md:col-span-10">
                <label class="block text-xs text-neutral-400 mb-1">Type</label>
                <input value="{{ old('type', $lamaran->lowongan?->type?->nama) }}" type="text" name="type" required class="w-full bg-black/50 border border-neutral-800 rounded-lg px-3 py-2 text-sm text-white disabled:bg-neutral-800 disabled:text-neutral-400 disabled:border-neutral-700 disabled:cursor-not-allowed" disabled>
                @error('type')
                    <small>{{ $message }}</small>
                @enderror
            </div>

            <!-- Jenjang -->
            <div class="md:col-span-10">
                <label class="block text-xs text-neutral-400 mb-1">Jenjang</label>
                <input value="{{ old('jenjang', $lamaran->lowongan?->jenjang?->nama) }}" jenjang="text" name="jenjang" required class="w-full bg-black/50 border border-neutral-800 rounded-lg px-3 py-2 text-sm text-white disabled:bg-neutral-800 disabled:text-neutral-400 disabled:border-neutral-700 disabled:cursor-not-allowed" disabled>
                @error('jenjang')
                    <small>{{ $message }}</small>
                @enderror
            </div>

            <!-- Keahlian -->
            <div class="md:col-span-10">
                <label class="block text-xs text-neutral-400 mb-1">Keahlian</label>
                <input value="{{ old('keahlian', $lamaran->lowongan?->keahlian?->nama) }}" keahlian="text" name="keahlian" required class="w-full bg-black/50 border border-neutral-800 rounded-lg px-3 py-2 text-sm text-white disabled:bg-neutral-800 disabled:text-neutral-400 disabled:border-neutral-700 disabled:cursor-not-allowed" disabled>
                @error('keahlian')
                    <small>{{ $message }}</small>
                @enderror
            </div>

            <!-- Keterangan (FULL ROW) -->
            <div class="md:col-span-10">
                <label class="block text-xs text-neutral-400 mb-1">Keterangan</label>
                <textarea name="keterangan" rows="3" class="w-full bg-black/50 border border-neutral-800 rounded-lg px-3 py-2 text-sm text-white disabled:bg-neutral-800 disabled:text-neutral-400 disabled:border-neutral-700 disabled:cursor-not-allowed" disabled>{{ old('keterangan', $lamaran->lowongan?->keterangan) }}</textarea>
                @error('keterangan')
                    <small>{{ $message }}</small>
                @enderror
            </div>

            <!-- Status -->
            <div>
                <label class="block text-xs text-neutral-400 mb-1">Status</label>
                <select name="status" required  class="w-full bg-black/50 border border-neutral-800 rounded-lg px-3 py-2 text-sm text-white">
                    <option value="pending" {{ old('status', $lamaran->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="diterima" {{ old('status', $lamaran->status) == 'diterima' ? 'selected' : '' }}>Diterima</option>
                    <option value="ditolak" {{ old('status', $lamaran->status) == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
                @error('status') 
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>
            @endif

            <!-- Pengguna -->
            @if(Auth::user()->role === 'pengguna')
            <!-- nama (FULL ROW) -->
            <div class="md:col-span-10">
                <label class="block text-xs text-neutral-400 mb-1">Nama</label>
                <input value="{{ old('nama', $lamaran->lowongan?->mitra?->nama) }}" type="text" name="nama" required class="w-full bg-black/50 border border-neutral-800 rounded-lg px-3 py-2 text-sm text-white disabled:bg-neutral-800 disabled:text-neutral-400 disabled:border-neutral-700 disabled:cursor-not-allowed" disabled>
                @error('nama')
                    <small>{{ $message }}</small>
                @enderror
            </div>

            <!-- Job (FULL ROW) -->
            <div class="md:col-span-10">
                <label class="block text-xs text-neutral-400 mb-1">Job</label>
                <input value="{{ old('job', $lamaran->lowongan?->job) }}" type="text" name="job" required class="w-full bg-black/50 border border-neutral-800 rounded-lg px-3 py-2 text-sm text-white disabled:bg-neutral-800 disabled:text-neutral-400 disabled:border-neutral-700 disabled:cursor-not-allowed" disabled>
                @error('job')
                    <small>{{ $message }}</small>
                @enderror
            </div>

            <!-- Type -->
            <div class="md:col-span-10">
                <label class="block text-xs text-neutral-400 mb-1">Type</label>
                <input value="{{ old('type', $lamaran->lowongan?->type?->nama) }}" type="text" name="type" required class="w-full bg-black/50 border border-neutral-800 rounded-lg px-3 py-2 text-sm text-white disabled:bg-neutral-800 disabled:text-neutral-400 disabled:border-neutral-700 disabled:cursor-not-allowed" disabled>
                @error('type')
                    <small>{{ $message }}</small>
                @enderror
            </div>

            <!-- Jenjang -->
            <div class="md:col-span-10">
                <label class="block text-xs text-neutral-400 mb-1">Jenjang</label>
                <input value="{{ old('jenjang', $lamaran->lowongan?->jenjang?->nama) }}" jenjang="text" name="jenjang" required class="w-full bg-black/50 border border-neutral-800 rounded-lg px-3 py-2 text-sm text-white disabled:bg-neutral-800 disabled:text-neutral-400 disabled:border-neutral-700 disabled:cursor-not-allowed" disabled>
                @error('jenjang')
                    <small>{{ $message }}</small>
                @enderror
            </div>

            <!-- Keahlian -->
            <div class="md:col-span-10">
                <label class="block text-xs text-neutral-400 mb-1">Keahlian</label>
                <input value="{{ old('keahlian', $lamaran->lowongan?->keahlian?->nama) }}" keahlian="text" name="keahlian" required class="w-full bg-black/50 border border-neutral-800 rounded-lg px-3 py-2 text-sm text-white disabled:bg-neutral-800 disabled:text-neutral-400 disabled:border-neutral-700 disabled:cursor-not-allowed" disabled>
                @error('keahlian')
                    <small>{{ $message }}</small>
                @enderror
            </div>

            <!-- Keterangan (FULL ROW) -->
            <div class="md:col-span-10">
                <label class="block text-xs text-neutral-400 mb-1">Keterangan</label>
                <textarea name="keterangan" rows="3" class="w-full bg-black/50 border border-neutral-800 rounded-lg px-3 py-2 text-sm text-white disabled:bg-neutral-800 disabled:text-neutral-400 disabled:border-neutral-700 disabled:cursor-not-allowed" disabled>{{ old('keterangan', $lamaran->lowongan?->keterangan) }}</textarea>
                @error('keterangan')
                    <small>{{ $message }}</small>
                @enderror
            </div>

            <!-- Status -->
            <div>
                <label class="block text-xs text-neutral-400 mb-1">Status</label>
                <select name="status" required  class="w-full bg-black/50 border border-neutral-800 rounded-lg px-3 py-2 text-sm text-white disabled:bg-neutral-800 disabled:text-neutral-400 disabled:border-neutral-700 disabled:cursor-not-allowed" disabled>
                    <option value="pending" {{ old('status', $lamaran->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="diterima" {{ old('status', $lamaran->status) == 'diterima' ? 'selected' : '' }}>Diterima</option>
                    <option value="ditolak" {{ old('status', $lamaran->status) == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
                @error('status') 
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <!-- Cv -->
            <div class="md:col-span-5">
                <label class="block text-xs text-neutral-400 mb-1">Cv</label>

                <input type="file"
                        name="cv"
                        accept="application/pdf"
                        required
                        class="w-full text-sm text-gray-400
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-lg file:border-0
                                file:bg-blue-600 file:text-white
                                hover:file:bg-blue-700
                                transition">
                                @error('cv')
                                <small>{{ $message }}</small>
                                @enderror
            </div>
            @endif
            

            <!-- ACTION -->
            <div class="md:col-span-10 flex justify-end gap-3 pt-4">
                <a href="{{ route('lamar') }}" class="px-6 py-2 rounded-lg bg-neutral-700 hover:bg-neutral-600 font-semibold">
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
