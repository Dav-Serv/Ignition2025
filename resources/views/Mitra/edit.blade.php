@extends('Layout.nav')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-28 pb-12">

    <!-- Header -->
    <div class="mb-8 border-b border-neutral-800 pb-6">
        <h1 class="text-3xl font-bold">Edit Lowongan</h1>
        <p class="text-sm text-neutral-500">
            Perbarui data lowongan
        </p>
    </div>

    <!-- FORM FULL WIDTH (SAMA DENGAN TABLE) -->
    <div class="glass p-8 w-full">
        <form action="{{ route('mitraUpdate', $mitra->id) }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @csrf
            @method('PUT')

            <!-- Type -->
            <div>
                <label class="block text-xs text-neutral-400 mb-1">Type</label>
                <select name="type" required class="w-full bg-black/50 border border-neutral-800 rounded-lg px-3 py-2 text-sm text-white">
                    <option disabled selected value="">-- Pilih Type --</option>
                    @foreach($types as $t)
                        <option value="{{ $t->id }}" {{ old('type', $mitra->id_type ?? '') == $t->id ? 'selected' : '' }}>{{ $t->nama }}</option>
                    @endforeach
                </select>
                @error('type')
                  <small>{{ $message }}</small>
                @enderror
            </div>

            <!-- Jenjang -->
            <div>
                <label class="block text-xs text-neutral-400 mb-1">Jenjang</label>
                <select name="jenjang" required class="w-full bg-black/50 border border-neutral-800 rounded-lg px-3 py-2 text-sm text-white">
                    <option disabled selected value="">-- Pilih Jenjang --</option>
                    @foreach($jenjangs as $j)
                        <option value="{{ $j->id }}" {{ old('jenjang', $mitra->id_jenjang ?? '') == $j->id ? 'selected' : '' }}>{{ $j->nama }}</option>
                    @endforeach
                </select>
                @error('jenjang')
                  <small>{{ $message }}</small>
                @enderror
            </div>

            <!-- Keahlian -->
            <div class="md:col-span-2">
                <label class="block text-xs text-neutral-400 mb-1">Keahlian</label>
                <select name="keahlian" required class="w-full bg-black/50 border border-neutral-800 rounded-lg px-3 py-2 text-sm text-white">
                    <option disabled selected value="">-- Pilih Keahlian --</option>
                    @foreach($keahlians as $k)
                        <option value="{{ $k->id }}" {{ old('keahlian', $mitra->id_keahlian ?? '') == $k->id ? 'selected' : '' }}>{{ $k->nama }}</option>
                    @endforeach
                </select>
                @error('keahlian')
                  <small>{{ $message }}</small>
                @enderror
            </div>
            
            <!-- Job (FULL ROW) -->
            <div class="md:col-span-2">
                <label class="block text-xs text-neutral-400 mb-1">Job</label>
                <input value="{{ old('job', $mitra->job) }}" type="text" name="job" required class="w-full bg-black/50 border border-neutral-800 rounded-lg px-3 py-2 text-sm text-white">
                @error('job')
                    <small>{{ $message }}</small>
                @enderror
            </div>

            <!-- Keterangan (FULL ROW) -->
            <div class="md:col-span-2">
                <label class="block text-xs text-neutral-400 mb-1">Keterangan</label>
                <textarea name="keterangan" rows="3" class="w-full bg-black/50 border border-neutral-800 rounded-lg px-3 py-2 text-sm text-white">{{ old('keterangan', $mitra->keterangan) }}</textarea>
                @error('keterangan')
                    <small>{{ $message }}</small>
                @enderror
            </div>

            <!-- ACTION -->
            <div class="md:col-span-2 flex justify-end gap-3 pt-4">
                <a href="{{ route('mitra') }}" class="px-6 py-2 rounded-lg bg-neutral-700 hover:bg-neutral-600 font-semibold">
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
