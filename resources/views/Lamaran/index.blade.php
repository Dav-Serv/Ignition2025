@extends('Layout.nav')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-28 pb-12">

    <!-- Header -->
    <div class="flex justify-between items-center mb-8 border-b border-neutral-800 pb-6">
        <div>
            <h1 class="text-3xl font-bold">List Lamaran</h1>
            <p class="text-sm text-neutral-500">Kelola Lamaran Magang Mania</p>
        </div>

    </div>

    <form onsubmit="return false" class="w-full max-w-8xl relative group mb-8">
        <div class="absolute inset-0 bg-blue-500/20 blur-2xl rounded-full opacity-0 group-hover:opacity-100 transition"></div>

        <div class="relative flex items-center bg-[#151515] border border-white/10 rounded-full pl-6 pr-2 py-2">
            <input
                type="text"
                id="searchInput"
                placeholder="Cari nama, email, jenis kelamin, job, alamat, dll..."
                class="flex-1 bg-transparent border-none focus:outline-none text-white h-12 text-lg">

            <button type="button"
                    class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-black">
                <i data-lucide="search" class="w-5 h-5"></i>
            </button>
        </div>
    </form>

    <!-- DESKTOP TABLE -->
    <div class="hidden md:block glass overflow-x-auto">
        <!-- Mitra -->
        @if(Auth::user()->role === "mitra")
        <table class="w-full">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>JK</th>
                    <th>Email</th>
                    <th>Telephone</th>
                    <th>Alamat</th>
                    <th>Job</th>
                    <th>Type</th>
                    <th>Jenjang</th>
                    <th>Keahlian</th>
                    <th>Keterangan</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($lamarans as $l)
                    <tr class="lamaran-row">
                        <!-- NOMOR TIDAK RESET -->
                        <td>{{ $lamarans->firstItem() + $loop->index }}</td>

                        <!-- FOTO -->
                        <td class="text-center">
                            @if($l->pengguna?->foto)
                                <img src="{{ asset('storage/'.$l->pengguna?->foto) }}"
                                     class="w-10 h-10 rounded-full object-cover mx-auto border border-white/10">
                            @else
                                <div class="w-10 h-10 rounded-full bg-neutral-700 flex items-center justify-center mx-auto text-xs text-neutral-300">
                                    N/A
                                </div>
                            @endif
                        </td>

                        <!-- data lamaran -->
                        <td>{{ $l->pengguna?->nama }}</td>
                        <td>{{ $l->pengguna?->jk }}</td>
                        <td>{{ $l->pengguna?->email }}</td>
                        <td>{{ $l->pengguna?->no_tlp }}</td>
                        <td>{{ $l->pengguna?->alamat }}</td>
                        <!-- data lowongan -->
                        <td>{{ $l->lowongan?->job }}</td>
                        <td>{{ $l->lowongan?->type?->nama }}</td>
                        <td>{{ $l->lowongan?->jenjang?->nama }}</td>
                        <td>{{ $l->lowongan?->keahlian?->nama }}</td>
                        <td>{{ $l->lowongan?->keterangan }}</td>
                        <!-- status lamaran -->
                        <td>
                            @php
                                $statusClass = match ($l->status) {
                                    'pending'    => 'bg-blue-500/10 text-blue-400 border border-blue-500/30',
                                    'ditolak'  => 'bg-red-500/10 text-red-400 border border-red-500/30',
                                    'diterima' => 'bg-green-500/10 text-green-400 border border-green-500/30',
                                    default    => 'bg-gray-500/10 text-gray-400 border border-gray-500/30',
                                };
                            @endphp
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $statusClass }}">
                                {{ ucfirst($l->status) }}
                            </span>
                        </td>

                        <td class="text-center">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('lamarPreview', $l->id) }}?v={{ $l->updated_at->timestamp }}" target="_blank" title="Preview CV" class="icon-btn">👁️</a>
                                <a href="{{ route('lamarEdit', $l->id) }}" class="icon-btn">✏️</a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="py-12 text-center text-neutral-500">
                            Belum ada user
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        @endif

        <!-- Pengguna -->
         @if(Auth::user()->role === "pengguna")
        <table class="w-full">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Job</th>
                    <th>Type</th>
                    <th>Jenjang</th>
                    <th>Keahlian</th>
                    <th>Keterangan</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($lamarans as $l)
                    <tr class="lamaran-row">
                        <!-- NOMOR TIDAK RESET -->
                        <td>{{ $lamarans->firstItem() + $loop->index }}</td>

                        <!-- FOTO -->
                        <td class="text-center">
                            @if($l->lowongan?->mitra?->foto)
                                <img src="{{ asset('storage/'.$l->lowongan?->mitra?->foto) }}"
                                     class="w-10 h-10 rounded-full object-cover mx-auto border border-white/10">
                            @else
                                <div class="w-10 h-10 rounded-full bg-neutral-700 flex items-center justify-center mx-auto text-xs text-neutral-300">
                                    N/A
                                </div>
                            @endif
                        </td>
                        <td>{{ $l->lowongan?->mitra?->nama }}</td>
                        <!-- data lowongan -->
                        <td>{{ $l->lowongan?->job }}</td>
                        <td>{{ $l->lowongan?->type?->nama }}</td>
                        <td>{{ $l->lowongan?->jenjang?->nama }}</td>
                        <td>{{ $l->lowongan?->keahlian?->nama }}</td>
                        <td>{{ $l->lowongan?->keterangan }}</td>
                        <!-- status lamaran -->
                        <td>
                            @php
                                $statusClass = match ($l->status) {
                                    'pending'    => 'bg-blue-500/10 text-blue-400 border border-blue-500/30',
                                    'ditolak'  => 'bg-red-500/10 text-red-400 border border-red-500/30',
                                    'diterima' => 'bg-green-500/10 text-green-400 border border-green-500/30',
                                    default    => 'bg-gray-500/10 text-gray-400 border border-gray-500/30',
                                };
                            @endphp
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $statusClass }}">
                                {{ ucfirst($l->status) }}
                            </span>
                        </td>

                        <td class="text-center">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('lamarPreview', $l->id) }}?v={{ $l->updated_at->timestamp }}" target="_blank" title="Preview CV" class="icon-btn">👁️</a>
                                @if ($l->status !== 'diterima')
                                <a href="{{ route('lamarEdit', $l->id) }}" class="icon-btn">✏️</a>
                                @endif
                                <form action="{{ route('lamarHapus', $l->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="hapusUser(this)" class="icon-btn">🗑️</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="py-12 text-center text-neutral-500">
                            Belum ada user
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        @endif
    </div>

    <!-- MOBILE CARD -->
    <div class="md:hidden space-y-4">
        <!-- Mitra -->
        @if(Auth::user()->role === "mitra")
        @forelse($lamarans as $l)
            <div class="glass p-4 rounded-xl lamaran-card">
                <div class="flex items-center gap-4">
                    @if($l->pengguna?->foto)
                        <img src="{{ asset('storage/'.$l->pengguna?->foto) }}" class="w-12 h-12 rounded-full object-cover">
                    @else
                        <div class="w-12 h-12 rounded-full bg-neutral-700 flex items-center justify-center text-xs">
                            N/A
                        </div>
                    @endif

                    <div class="flex-1">
                        <p class="font-semibold text-white">{{ $l->pengguna?->nama }}</p>
                    </div>
                </div>

                <div class="mt-3 text-sm text-neutral-300 space-y-1">
                    <p><span class="text-neutral-500">jenis kelamin :</span> {{ $l->pengguna?->jk }}</p>
                    <p><span class="text-neutral-500">email         :</span> {{ $l->pengguna?->email }}</p>
                    <p><span class="text-neutral-500">telephone     :</span> {{ $l->pengguna?->no_tlp }}</p>
                    <p><span class="text-neutral-500">alamat        :</span> {{ $l->pengguna?->alamat }}</p>
                    <p><span class="text-neutral-500">job           :</span> {{ $l->lowongan?->job }}</p>
                    <p><span class="text-neutral-500">type          :</span> {{ $l->lowongan?->type?->nama }}</p>
                    <p><span class="text-neutral-500">jenjang       :</span> {{ $l->lowongan?->jenjang?->nama }}</p>
                    <p><span class="text-neutral-500">keahlian      :</span> {{ $l->lowongan?->keahlian?->nama }}</p>
                    <p><span class="text-neutral-500">keterangan    :</span> {{ $l->lowongan?->keterangan }}</p>
                    @php
                    $statusClass = match ($l->status) {
                        'pending'    => 'bg-blue-500/10 text-blue-400 border border-blue-500/30',
                        'ditolak'  => 'bg-red-500/10 text-red-400 border border-red-500/30',
                        'diterima' => 'bg-green-500/10 text-green-400 border border-green-500/30',
                        default    => 'bg-gray-500/10 text-gray-400 border border-gray-500/30',
                    };
                    @endphp
                    <p>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $statusClass }}">
                            {{ ucfirst($l->status) }}
                        </span>
                    </p>
                </div>

                <div class="flex gap-2 mt-4">
                    <a href="{{ route('lamarPreview', $l->id) }}?v={{ $l->updated_at->timestamp }}" target="_blank" title="Preview CV"
                       class="flex-1 text-center bg-yellow-500 py-2 rounded-lg text-sm font-semibold">
                        Lihat
                    </a>
                    <a href="{{ route('lamarEdit', $l->id) }}"
                       class="flex-1 text-center bg-blue-600 py-2 rounded-lg text-sm font-semibold">
                        Edit
                    </a>
                </div>
            </div>
        @empty
            <div class="text-center text-neutral-500 py-10">
                Belum ada user
            </div>
        @endforelse
        @endif

        <!-- Pengguna -->
        @if(Auth::user()->role === "pengguna")
        @forelse($lamarans as $l)
            <div class="glass p-4 rounded-xl lamaran-card">
                <div class="flex items-center gap-4">
                    @if($l->lowongan?->mitra?->foto)
                        <img src="{{ asset('storage/'.$l->lowongan?->mitra?->foto) }}" class="w-12 h-12 rounded-full object-cover">
                    @else
                        <div class="w-12 h-12 rounded-full bg-neutral-700 flex items-center justify-center text-xs">
                            N/A
                        </div>
                    @endif

                    <div class="flex-1">
                        <p class="font-semibold text-white">{{ $l->lowongan?->mitra?->nama }}</p>
                    </div>
                </div>

                <div class="mt-3 text-sm text-neutral-300 space-y-1">
                    <p><span class="text-neutral-500">job       :</span> {{ $l->lowongan?->job }}</p>
                    <p><span class="text-neutral-500">type      :</span> {{ $l->lowongan?->type?->nama }}</p>
                    <p><span class="text-neutral-500">jenjang   :</span> {{ $l->lowongan?->jenjang?->nama }}</p>
                    <p><span class="text-neutral-500">keahlian  :</span> {{ $l->lowongan?->keahlian?->nama }}</p>
                    <p><span class="text-neutral-500">keterangan:</span> {{ $l->lowongan?->keterangan }}</p>
                    @php
                    $statusClass = match ($l->status) {
                        'pending'    => 'bg-blue-500/10 text-blue-400 border border-blue-500/30',
                        'ditolak'  => 'bg-red-500/10 text-red-400 border border-red-500/30',
                        'diterima' => 'bg-green-500/10 text-green-400 border border-green-500/30',
                        default    => 'bg-gray-500/10 text-gray-400 border border-gray-500/30',
                    };
                    @endphp
                    <p>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $statusClass }}">
                            {{ ucfirst($l->status) }}
                        </span>
                    </p>
                </div>

                <div class="flex gap-2 mt-4">
                    <a href="{{ route('lamarPreview', $l->id) }}?v={{ $l->updated_at->timestamp }}" target="_blank" title="Preview CV"
                       class="flex-1 text-center bg-yellow-500 py-2 rounded-lg text-sm font-semibold">
                        Lihat
                    </a>
                    @if ($l->status !== 'diterima')
                    <a href="{{ route('lamarEdit', $l->id) }}"
                       class="flex-1 text-center bg-blue-600 py-2 rounded-lg text-sm font-semibold">
                        Edit
                    </a>
                    @endif
                    <form action="{{ route('lamarHapus', $l->id) }}" method="POST" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="hapusUser(this)"
                                class="w-full bg-red-600 py-2 rounded-lg text-sm font-semibold">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="text-center text-neutral-500 py-10">
                Belum ada user
            </div>
        @endforelse
        @endif
    </div>

    <!-- PAGINATION -->
    <div class="mt-6">
        {{ $lamarans->links() }}
    </div>
</div>

<script>
function hapusUser(button) {
    const form = button.closest('form');
    Swal.fire({
        title: 'Yakin ingin Hapus?',
        text: 'Anda akan Menghapus Data Lamaran.',
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

    const rows = document.querySelectorAll(".lamaran-row");
    const cards = document.querySelectorAll(".lamaran-card");

    function filterLamaran() {
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

    searchInput.addEventListener("input", filterLamaran);
});
</script>
@endsection
