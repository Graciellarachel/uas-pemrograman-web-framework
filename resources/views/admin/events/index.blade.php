<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Event') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <!-- Header Section -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="h5 mb-0 text-gray-900">Daftar Event</h3>
                    <a href="{{ route('events.create') }}" class="btn btn-primary d-flex align-items-center">
                        <span class="me-1">+</span> Tambah Event
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
                                <th class="py-3 px-4">Nama Event</th>
                                <th class="py-3 px-4">Tanggal</th>
                                <th class="py-3 px-4">Lokasi</th>
                                <th class="py-3 px-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                            @forelse($events as $event)
                            <tr>
                                <td class="py-3 px-4 font-weight-bold">{{ $event->nama_event }}</td>
                                <td class="py-3 px-4">{{ \Carbon\Carbon::parse($event->tanggal_event)->format('d M Y') }}</td>
                                <td class="py-3 px-4">{{ $event->lokasi }}</td>
                                <td class="py-3 px-4">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('events.edit', $event) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                        <form action="{{ route('events.destroy', $event) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted small">Belum ada data event.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
