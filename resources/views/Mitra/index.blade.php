@extends('Layout.nav')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-28 pb-12">

    <!-- Header -->
    <div class="flex justify-between items-center mb-8 border-b border-neutral-800 pb-6">
        <div>
            <h1 class="text-3xl font-bold">List Lowongan</h1>
            <p class="text-sm text-neutral-500">Kelola Lowongan Magang Mania</p>
        </div>

        <a href="{{ route('mitraTambah') }}"
           class="inline-flex items-center gap-2 bg-white text-black px-4 py-2 rounded-lg font-semibold hover:bg-neutral-200 transition">
            + Tambah
        </a>
    </div>

    <!-- DESKTOP TABLE -->
    <div class="hidden md:block glass overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Type</th>
                    <th>Jenjang</th>
                    <th>Keahlian</th>
                    <th>Job</th>
                    <th>Keterangan</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($mitras as $m)
                    <tr>
                        <!-- NOMOR TIDAK RESET -->
                        <td>{{ $mitras->firstItem() + $loop->index }}</td>

                        <!-- FOTO -->
                        <td class="text-center">
                            @if($m->mitra?->foto)
                                <img src="{{ asset('storage/'.$m->mitra?->foto) }}"
                                     class="w-10 h-10 rounded-full object-cover mx-auto border border-white/10">
                            @else
                                <div class="w-10 h-10 rounded-full bg-neutral-700 flex items-center justify-center mx-auto text-xs text-neutral-300">
                                    N/A
                                </div>
                            @endif
                        </td>

                        <td>{{ $m->mitra?->nama }}</td>
                        <td>{{ $m->type?->nama }}</td>
                        <td>{{ $m->jenjang?->nama }}</td>
                        <td>{{ $m->keahlian?->nama }}</td>
                        <td>{{ $m->job }}</td>
                        <td>{{ $m->keterangan }}</td>

                        <td class="text-center">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('mitraEdit', $m->id) }}" class="icon-btn">✏️</a>
                                <form action="{{ route('mitraHapus', $m->id) }}" method="POST">
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
        @forelse($mitras as $m)
            <div class="glass p-4 rounded-xl">
                <div class="flex items-center gap-4">
                    @if($m->mitra?->foto)
                        <img src="{{ asset('storage/'.$m->mitra?->foto) }}" class="w-12 h-12 rounded-full object-cover">
                    @else
                        <div class="w-12 h-12 rounded-full bg-neutral-700 flex items-center justify-center text-xs">
                            N/A
                        </div>
                    @endif

                    <div class="flex-1">
                        <p class="font-semibold text-white">{{ $m->mitra?->nama }}</p>
                        <p class="text-xs text-neutral-400">{{ $m->type?->nama }}</p>
                        <p class="text-xs text-neutral-400">{{ $m->jenjang?->nama }}</p>
                        <p class="text-xs text-neutral-400">{{ $m->keahlian?->nama }}</p>
                    </div>
                </div>

                <div class="mt-3 text-sm text-neutral-300 space-y-1">
                    <p><span class="text-neutral-500">job:</span> {{ $m->job }}</p>
                    <p><span class="text-neutral-500">keterangan:</span> {{ $m->keterangan }}</p>
                </div>

                <div class="flex gap-2 mt-4">
                    <a href="{{ route('mitraEdit', $m->id) }}"
                       class="flex-1 text-center bg-blue-600 py-2 rounded-lg text-sm font-semibold">
                        Edit
                    </a>
                    <form action="{{ route('mitraHapus', $m->id) }}" method="POST" class="flex-1">
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
        {{ $mitras->links() }}
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
@endsection
