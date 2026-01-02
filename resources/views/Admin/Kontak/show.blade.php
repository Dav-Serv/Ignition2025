@extends('Layout.nav')

@section('content')
<main class="flex-grow pt-32 pb-20 px-6">
    <div class="max-w-5xl mx-auto">

        <!-- Back -->
        <a href="{{ route('kontak') }}" class="inline-flex px-6 py-2 rounded-lg bg-neutral-700 hover:bg-neutral-600 font-semibold mb-8">
            Kembali
        </a>

        <!-- Header -->
        <div class="bg-[#0f0f0f] border border-white/5 rounded-2xl p-8 mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">

                <!-- Info -->
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold mb-4">
                        {{ $kontak->nama }}
                    </h1>

                    <div class="flex flex-wrap gap-3 text-sm text-gray-400">
                        <span class="flex items-center gap-2">
                            <i data-lucide="mail"></i>
                            {{ $kontak->email }}
                        </span>
                        <span class="flex items-center gap-2">
                            <i data-lucide="phone"></i>
                            <a href="https://wa.me/62{{ $kontak->no_tlp }}" target="_blank" class="text-gray-300 hover:text-blue-400 hover:underline transition-colors">{{ $kontak->no_tlp }}</a>
                        </span>
                    </div>
                </div>

                <!-- Tombol Dibaca -->           
                @auth
                @if(Auth::user()->role === 'admin')
                <form action="{{ route('kontakUpdate', $kontak->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="button" onclick="dibaca(this)"
                        class="inline-flex items-center gap-2 px-6 py-3
                            bg-blue-600 hover:bg-blue-700
                            text-white font-semibold rounded-xl
                            transition-all shadow-lg shadow-blue-600/20">
                        <i data-lucide="send" class="w-4 h-4"></i>
                        Tandai Dibaca
                    </button>
                </form>
                @endif
                @endauth
            </div>
        </div>

        <!-- Keperluan -->
        <div class="bg-[#0f0f0f] border border-white/5 rounded-2xl p-8">
            <h3 class="text-xl font-semibold mb-4">Keperluan</h3>
            <p class="text-gray-400 leading-relaxed whitespace-pre-line break-words">
                {{ $kontak->keperluan }}
            </p>
        </div>

    </div>
</main>

<script>
function dibaca(button) {
    const form = button.closest('form');
    Swal.fire({
        title: 'Yakin menandai dibaca?',
        text: 'Anda akan menandai kalau telah dibaca.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Dibaca',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
}
</script>
@endsection
