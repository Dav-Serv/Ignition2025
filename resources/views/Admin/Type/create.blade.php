@extends('Layout.nav')

@section('content')
<div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-28 pb-12">

    <!-- Header -->
    <div class="mb-8 border-b border-neutral-800 pb-6">
        <h1 class="text-3xl font-bold">Tambah Type</h1>
        <p class="text-sm text-neutral-500">
            Tambahkan type baru ke dalam sistem
        </p>
    </div>

    <!-- FORM -->
    <div class="glass p-8 w-full max-w-xl">
        <form action="{{ route('typeStore') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Nama -->
            <div>
                <label class="block text-xs text-neutral-400 mb-1">Nama Type</label>
                <input name="nama" value="{{ old('nama') }}" required class="w-full bg-black/50 border border-neutral-800 rounded-lg px-3 py-2 text-sm text-white">

                @error('nama')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <!-- ACTION -->
            <div class="flex justify-end gap-3 pt-4">
                <a href="{{ route('type') }}" class="px-6 py-2 rounded-lg bg-neutral-700 hover:bg-neutral-600 font-semibold">
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
