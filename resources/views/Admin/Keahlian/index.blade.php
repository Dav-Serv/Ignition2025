@extends('Layout.nav')

@section('content')
<div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-28 pb-12">

    <!-- Header -->
    <div class="flex justify-between items-center mb-8 border-b border-neutral-800 pb-6">
        <div>
            <h1 class="text-3xl font-bold">List Keahlian</h1>
            <p class="text-sm text-neutral-500">Kelola Keahlian Magang Mania</p>
        </div>

        <a href="{{ route('keahlianTambah') }}" class="inline-flex items-center gap-2 bg-white text-black px-4 py-2 rounded-lg font-semibold hover:bg-neutral-200 transition">
            + Tambah
        </a>
    </div>

    <form onsubmit="return false" class="w-full max-w-2xl relative group mb-8">
        <div class="absolute inset-0 bg-blue-500/20 blur-2xl rounded-full opacity-0 group-hover:opacity-100 transition"></div>

        <div class="relative flex items-center bg-[#151515] border border-white/10 rounded-full pl-6 pr-2 py-2">
            <input
                type="text"
                id="searchInput"
                placeholder="Cari Keahlian"
                class="flex-1 bg-transparent border-none focus:outline-none text-white h-12 text-lg">

            <button type="button"
                    class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-black">
                <i data-lucide="search" class="w-5 h-5"></i>
            </button>
        </div>
    </form>

    <!-- DESKTOP TABLE -->
    <div class="hidden md:block glass overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr>
                    <th class="w-16">No</th>
                    <th>Nama Keahlian</th>
                    <th class="text-center w-32">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($keahlians as $k)
                    <tr class="keahlian-row">
                        <td>{{ $keahlians->firstItem() + $loop->index }}</td>
                        <td class="font-medium text-white">{{ $k->nama }}</td>
                        <td class="text-center">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('keahlianEdit', ['keahlian' => $k->id]) }}" class="icon-btn">✏️</a>

                                <form action="{{ route('keahlianHapus', ['keahlian' => $k->id])  }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                            onclick="hapusData(this)"
                                            class="icon-btn">
                                        🗑️
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="py-12 text-center text-neutral-500">
                            Belum ada keahlian
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- MOBILE CARD -->
    <div class="md:hidden space-y-4">
        @forelse($keahlians as $k)
            <div class="glass p-4 rounded-xl keahlian-card">
                <p class="font-semibold text-white">{{ $k->nama }}</p>

                <div class="flex gap-2 mt-4">
                    <a href="{{ route('keahlianEdit', ['keahlian' => $k->id]) }}" class="flex-1 text-center bg-blue-600 py-2 rounded-lg text-sm font-semibold">
                        Edit
                    </a>

                    <form action="{{ route('keahlianHapus', ['keahlian' => $k->id])  }}" method="POST" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="hapusData(this)" class="w-full bg-red-600 py-2 rounded-lg text-sm font-semibold">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="text-center text-neutral-500 py-10">
                Belum ada keahlian
            </div>
        @endforelse
    </div>

    <!-- PAGINATION -->
    <div class="mt-6">
        {{ $keahlians->links() }}
    </div>
</div>

<!-- SWEETALERT DELETE -->
<script>
function hapusData(button) {
    const form = button.closest('form');

    Swal.fire({
        title: 'Yakin ingin hapus?',
        text: 'Anda akan Menghapus Data Keahlian.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
}
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("searchInput");

    const rows = document.querySelectorAll(".keahlian-row");
    const cards = document.querySelectorAll(".keahlian-card");

    function filterKeahlian() {
        const q = searchInput.value.toLowerCase().trim();

        // Desktop
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.classList.toggle("hidden", !text.includes(q));
        });

        // Mobile
        cards.forEach(card => {
            const text = card.textContent.toLowerCase();
            card.classList.toggle("hidden", !text.includes(q));
        });
    }

    searchInput.addEventListener("input", filterKeahlian);
});
</script>

@endsection
