@extends('Layout.nav')

@section('content')
<div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-28 pb-12">

    <!-- Header -->
    <div class="flex justify-between items-center mb-8 border-b border-neutral-800 pb-6">
        <div>
            <h1 class="text-3xl font-bold">List Kontak</h1>
            <p class="text-sm text-neutral-500">Kelola Kontak Masuk Magang Mania</p>
        </div>
    </div>

    <!-- DESKTOP TABLE -->
    <div class="hidden md:block glass overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr>
                    <th class="w-16">No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telephone</th>
                    <th>Respon</th>
                    <th class="text-center w-32">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kontaks as $k)
                    <tr>
                        <td>{{ $kontaks->firstItem() + $loop->index }}</td>
                        <td class="font-medium text-white">{{ $k->nama }}</td>
                        <td class="font-medium text-white">{{ $k->email }}</td>
                        <td class="font-medium text-white">{{ $k->no_tlp }}</td>
                        <td>
                            @php
                            $responClass = match ($k->respon) {
                                'pending'       => 'bg-blue-500/10 text-blue-400 border border-blue-500/30',
                                'dibaca'      => 'bg-green-500/10 text-green-400 border border-green-500/30',
                                default         => 'bg-gray-500/10 text-gray-400 border border-gray-500/30',
                            };
                            @endphp
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $responClass }}">
                                {{ ucfirst($k->respon) }}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('kontakShow', $k->id) }}" class="icon-btn">👁️</a>
                                <form action="{{ route('kontakHapus', $k->id) }}" method="POST">
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
                            Belum ada jenjang
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- MOBILE CARD -->
    <div class="md:hidden space-y-4">
        @forelse($kontaks as $k)
            <div class="glass p-4 rounded-xl">
                <div class="flex items-center gap-4">
                    <div class="flex-1">
                        <p class="font-semibold text-white">{{ $k->nama }}</p>
                    </div>
                </div>

                <div class="mt-3 text-sm text-neutral-300 space-y-1">
                    <p><span class="text-neutral-500">Email          :</span> {{ $k->email }}</p>
                    <p><span class="text-neutral-500">Telephone      :</span> {{ $k->no_tlp }}</p>
                    @php
                    $responClass = match ($k->respon) {
                        'pending'       => 'bg-blue-500/10 text-blue-400 border border-blue-500/30',
                        'dibaca'        => 'bg-green-500/10 text-green-400 border border-green-500/30',
                        default         => 'bg-gray-500/10 text-gray-400 border border-gray-500/30',
                    };
                    @endphp
                    <p>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $responClass }}">
                            {{ ucfirst($k->respon) }}
                        </span>
                    </p>
                </div>

                <div class="flex gap-2 mt-4">
                    <a href="{{ route('kontakShow', $k->id) }}" class="flex-1 text-center bg-blue-600 py-2 rounded-lg text-sm font-semibold">
                        Keperluan
                    </a>

                    <form action="{{ route('kontakHapus', $k->id) }}" method="POST" class="flex-1">
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
                Belum ada jenjang
            </div>
        @endforelse
    </div>

    <!-- PAGINATION -->
    <div class="mt-6">
        {{ $kontaks->links() }}
    </div>
</div>

<!-- SWEETALERT DELETE -->
<script>
function hapusData(button) {
    const form = button.closest('form');

    Swal.fire({
        title: 'Yakin ingin hapus?',
        text: 'Anda akan Menghapus Data Kontak Pesan.',
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
