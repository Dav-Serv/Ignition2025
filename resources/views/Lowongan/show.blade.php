@extends('Layout.nav')

@section('content')
<main class="flex-grow pt-32 pb-20 px-6">
    <div class="max-w-5xl mx-auto">

        <!-- Back -->
        <a href="{{ route('lowongan') }}" class="inline-flex px-6 py-2 rounded-lg bg-neutral-700 hover:bg-neutral-600 font-semibold mb-8">
            Kembali
        </a>

        <!-- Header -->
        <div class="bg-[#0f0f0f] border border-white/5 rounded-2xl p-8 mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">

                <!-- Info -->
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold mb-4">
                        {{ $lowongan->job }}
                    </h1>

                    <div class="flex flex-wrap gap-3 text-sm text-gray-400">
                        <span class="flex items-center gap-2">
                            <i data-lucide="briefcase"></i>
                            {{ $lowongan->type?->nama }}
                        </span>
                        <span class="flex items-center gap-2">
                            <i data-lucide="graduation-cap"></i>
                            {{ $lowongan->jenjang?->nama }}
                        </span>
                        <span class="flex items-center gap-2">
                            <i data-lucide="code"></i>
                            {{ $lowongan->keahlian?->nama }}
                        </span>
                    </div>
                </div>

                <!-- Tombol Lamar -->
                @auth
                @if(Auth::user()->role === 'pengguna')
                <button onclick="openApplyModal()"
                    class="inline-flex items-center gap-2 px-6 py-3
                        bg-blue-600 hover:bg-blue-700
                        text-white font-semibold rounded-xl
                        transition-all shadow-lg shadow-blue-600/20">
                    <i data-lucide="send" class="w-4 h-4"></i>
                    Lamar Sekarang
                </button>
                @endif
                @else
                <a href="{{ route('login') }}"
                class="inline-flex items-center gap-2 px-6 py-3
                        bg-gray-700 hover:bg-gray-600
                        text-white font-semibold rounded-xl transition">
                    Login untuk Melamar
                </a>
                @endauth


            </div>
        </div>

        <!-- Company -->
        <div class="bg-[#0f0f0f] border border-white/5 rounded-2xl p-8 mb-8">
            <div class="flex items-center gap-4">
                <img src="{{ Storage::url($lowongan->mitra?->foto) }}" src="{{ asset('storage/'.$lowongan->mitra?->foto) }}"
                     class="w-16 h-16 rounded-full object-cover border border-white/10">
                <div>
                    <h3 class="text-lg font-semibold">
                        {{ $lowongan->mitra?->nama }}
                    </h3>
                    <p class="text-sm text-gray-400">
                        {{ $lowongan->mitra?->alamat }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Description -->
        <div class="bg-[#0f0f0f] border border-white/5 rounded-2xl p-8">
            <h3 class="text-xl font-semibold mb-4">Deskripsi Lowongan</h3>
            <p class="text-gray-400 leading-relaxed whitespace-pre-line">
                {{ $lowongan->keterangan ?? 'Belum ada deskripsi.' }}
            </p>
        </div>

    </div>

    <!-- Modal Lamar -->
    <div id="applyModal"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 backdrop-blur-sm">

        <div class="bg-[#0f0f0f] w-full max-w-md rounded-2xl border border-white/10 p-6 relative">

            <!-- Close -->
            <button onclick="closeApplyModal()"
                    class="absolute top-4 right-4 text-gray-400 hover:text-white">
                ✕
            </button>

            <h3 class="text-xl font-bold mb-2">Lamar Lowongan</h3>
            <p class="text-sm text-gray-400 mb-6">
                Upload CV Anda (PDF, maksimal 2MB)
            </p>

            <form action="{{ route('lamaran', $lowongan->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <!-- File Input -->
                <div>
                    <label class="block text-sm mb-2 text-gray-400">CV (PDF)</label>
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

                <div class="mt-3">
                    <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>

                    @error('g-recaptcha-response')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <script src="https://www.google.com/recaptcha/api.js" async defer></script>

                <!-- Actions -->
                <div class="flex justify-end gap-3 pt-4">
                    <button type="button"
                            onclick="closeApplyModal()"
                            class="px-4 py-2 text-sm rounded-lg
                                bg-gray-700 hover:bg-gray-600">
                        Batal
                    </button>

                    <button type="submit"
                            class="px-5 py-2 text-sm rounded-lg
                                bg-blue-600 hover:bg-blue-700
                                font-semibold text-white">
                        Kirim Lamaran
                    </button>
                </div>
            </form>

        </div>
    </div>

</main>

<script>
function openApplyModal() {
    document.getElementById('applyModal').classList.remove('hidden');
    document.getElementById('applyModal').classList.add('flex');
}

function closeApplyModal() {
    document.getElementById('applyModal').classList.add('hidden');
    document.getElementById('applyModal').classList.remove('flex');
}
</script>

@endsection
