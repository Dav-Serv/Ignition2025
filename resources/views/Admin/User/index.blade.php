@extends('Layout.nav')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-28 pb-12">

    <!-- Header -->
    <div class="flex justify-between items-center mb-8 border-b border-neutral-800 pb-6">
        <div>
            <h1 class="text-3xl font-bold">List User</h1>
            <p class="text-sm text-neutral-500">Kelola User Magang Mania</p>
        </div>

        <a href="{{ route('userTambah') }}"
           class="inline-flex items-center gap-2 bg-white text-black px-4 py-2 rounded-lg font-semibold hover:bg-neutral-200 transition">
            + Tambah
        </a>
    </div>
    
    <form onsubmit="return false" class="w-full max-w-5xl relative group mb-8">
        <div class="absolute inset-0 bg-blue-500/20 blur-2xl rounded-full opacity-0 group-hover:opacity-100 transition"></div>

        <div class="relative flex items-center bg-[#151515] border border-white/10 rounded-full pl-6 pr-2 py-2">
            <input
                type="text"
                id="searchInput"
                placeholder="Cari nama, email, role, atau alamat..."
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
                    <th>No</th>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telephone</th>
                    <th>Role</th>
                    <th>Alamat</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $u)
                    <tr class="user-row">
                        <!-- NOMOR TIDAK RESET -->
                        <td>{{ $users->firstItem() + $loop->index }}</td>

                        <!-- FOTO -->
                        <td class="text-center">
                            @if($u->foto)
                                <img src="{{ asset('storage/'.$u->foto) }}"
                                     class="w-10 h-10 rounded-full object-cover mx-auto border border-white/10">
                            @else
                                <div class="w-10 h-10 rounded-full bg-neutral-700 flex items-center justify-center mx-auto text-xs text-neutral-300">
                                    N/A
                                </div>
                            @endif
                        </td>

                        <td>{{ $u->nama }}</td>
                        <td>{{ $u->email }}</td>
                        <td>{{ $u->no_tlp }}</td>

                        <!-- ROLE BADGE -->
                        <td>
                            @php
                                $roleClass = match ($u->role) {
                                    'admin'    => 'bg-purple-500/10 text-purple-400 border border-purple-500/30',
                                    'mitra'    => 'bg-blue-500/10 text-blue-400 border border-blue-500/30',
                                    'pengguna' => 'bg-green-500/10 text-green-400 border border-green-500/30',
                                    default    => 'bg-gray-500/10 text-gray-400 border border-gray-500/30',
                                };
                            @endphp
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $roleClass }}">
                                {{ ucfirst($u->role) }}
                            </span>
                        </td>

                        <td>{{ $u->alamat }}</td>

                        <td class="text-center">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('userEdit', $u->id) }}" class="icon-btn">✏️</a>
                                <form action="{{ route('userHapus', $u->id) }}" method="POST">
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
    </div>

    <!-- MOBILE CARD -->
    <div class="md:hidden space-y-4">
        @forelse($users as $u)
            <div class="glass p-4 rounded-xl user-card">
                <div class="flex items-center gap-4">
                    @if($u->foto)
                        <img src="{{ asset('storage/'.$u->foto) }}" class="w-12 h-12 rounded-full object-cover">
                    @else
                        <div class="w-12 h-12 rounded-full bg-neutral-700 flex items-center justify-center text-xs">
                            N/A
                        </div>
                    @endif

                    <div class="flex-1">
                        <p class="font-semibold text-white">{{ $u->nama }}</p>
                        <p class="text-xs text-neutral-400">{{ $u->email }}</p>
                    </div>

                    @php
                        $roleClass = match ($u->role) {
                            'admin'    => 'bg-purple-500/10 text-purple-400',
                            'mitra'    => 'bg-blue-500/10 text-blue-400',
                            'pengguna' => 'bg-green-500/10 text-green-400',
                            default    => 'bg-gray-500/10 text-gray-400',
                        };
                    @endphp
                    <span class="px-2 py-1 text-xs rounded-full {{ $roleClass }}">
                        {{ ucfirst($u->role) }}
                    </span>
                </div>

                <div class="mt-3 text-sm text-neutral-300 space-y-1">
                    <p><span class="text-neutral-500">Telepon:</span> {{ $u->no_tlp }}</p>
                    <p><span class="text-neutral-500">Alamat:</span> {{ $u->alamat }}</p>
                </div>

                <div class="flex gap-2 mt-4">
                    <a href="{{ route('userEdit', $u->id) }}"
                       class="flex-1 text-center bg-blue-600 py-2 rounded-lg text-sm font-semibold">
                        Edit
                    </a>
                    <form action="{{ route('userHapus', $u->id) }}" method="POST" class="flex-1">
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
    </div>

    <!-- PAGINATION -->
    <div class="mt-6">
        {{ $users->links() }}
    </div>
</div>

<script>
function hapusUser(button) {
    const form = button.closest('form');
    Swal.fire({
        title: 'Yakin ingin Hapus?',
        text: 'Anda akan Menghapus Data User.',
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

    const rows = document.querySelectorAll(".user-row");
    const cards = document.querySelectorAll(".user-card");

    function filterUsers() {
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

    searchInput.addEventListener("input", filterUsers);
});
</script>

@endsection
