<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Jenis Tiket') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <!-- Header Section -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="h5 mb-0 text-gray-900">Daftar Jenis Tiket</h3>
                    <a href="{{ route('tickets.create') }}" class="btn btn-primary d-flex align-items-center">
                        <span class="me-1">+</span> Tambah Tiket
                    </a>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover table-striped border">
                        <thead class="table-light text-secondary">
                            <tr>
                                <th class="py-3 px-4">Event</th>
                                <th class="py-3 px-4">Nama Tiket</th>
                                <th class="py-3 px-4">Harga</th>
                                <th class="py-3 px-4">Stok</th>
                                <th class="py-3 px-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                            @forelse($tickets as $ticket)
                            <tr>
                                <td class="py-3 px-4">{{ $ticket->event->nama_event }}</td>
                                <td class="py-3 px-4">{{ $ticket->nama_tiket }}</td>
                                <td class="py-3 px-4 font-weight-bold">Rp {{ number_format($ticket->harga, 0, ',', '.') }}</td>
                                <td class="py-3 px-4">{{ $ticket->stok }}</td>
                                <td class="py-3 px-4">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('tickets.edit', $ticket) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                        <form action="{{ route('tickets.destroy', $ticket) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted small">Belum ada data tiket.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
