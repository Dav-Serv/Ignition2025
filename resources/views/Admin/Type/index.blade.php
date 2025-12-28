@extends('Layout.nav')

@section('content')
<div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-28 pb-12">

    <!-- Header -->
    <div class="flex justify-between items-center mb-8 border-b border-neutral-800 pb-6">
        <div>
            <h1 class="text-3xl font-bold">List Type</h1>
            <p class="text-sm text-neutral-500">Kelola Type Magang Mania</p>
        </div>

        <a href="{{ route('typeTambah') }}" class="inline-flex items-center gap-2 bg-white text-black px-4 py-2 rounded-lg font-semibold hover:bg-neutral-200 transition">
            + Tambah
        </a>
    </div>

    <!-- DESKTOP TABLE -->
    <div class="hidden md:block glass overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr>
                    <th class="w-16">No</th>
                    <th>Nama Type</th>
                    <th class="text-center w-32">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($types as $t)
                    <tr>
                        <td>{{ $types->firstItem() + $loop->index }}</td>
                        <td class="font-medium text-white">{{ $t->nama }}</td>
                        <td class="text-center">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('typeEdit', ['type' => $t->id]) }}" class="icon-btn">✏️</a>

                                <form action="{{ route('typeHapus', ['type' => $t->id])  }}" method="POST">
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
                            Belum ada type
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- MOBILE CARD -->
    <div class="md:hidden space-y-4">
        @forelse($types as $t)
            <div class="glass p-4 rounded-xl">
                <p class="font-semibold text-white">{{ $t->nama }}</p>

                <div class="flex gap-2 mt-4">
                    <a href="{{ route('typeEdit', ['type' => $t->id]) }}" class="flex-1 text-center bg-blue-600 py-2 rounded-lg text-sm font-semibold">
                        Edit
                    </a>

                    <form action="{{ route('typeHapus', ['type' => $t->id])  }}" method="POST" class="flex-1">
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
                Belum ada type
            </div>
        @endforelse
    </div>

    <!-- PAGINATION -->
    <div class="mt-6">
        {{ $types->links() }}
    </div>
</div>

<!-- SWEETALERT DELETE -->
<script>
function hapusData(button) {
    const form = button.closest('form');

    Swal.fire({
        title: 'Yakin ingin hapus?',
        text: 'Data type akan dihapus permanen.',
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
