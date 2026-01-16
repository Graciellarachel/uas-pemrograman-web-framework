<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Event') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="row g-4">
                    @forelse($events as $event)
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 shadow-sm border-0">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold">{{ $event->nama_event }}</h5>
                                    <p class="card-text text-muted small mb-2">
                                        <i class="bi bi-calendar"></i> {{ \Carbon\Carbon::parse($event->tanggal_event)->format('d M Y') }}
                                    </p>
                                    <p class="card-text text-muted small mb-3">
                                        <i class="bi bi-geo-alt"></i> {{ $event->lokasi }}
                                    </p>
                                    @if($event->deskripsi)
                                        <p class="card-text small">{{ Str::limit($event->deskripsi, 100) }}</p>
                                    @endif
                                    <a href="{{ route('user.events.show', $event) }}" class="btn btn-primary btn-sm mt-2 w-100">
                                        Lihat Detail & Beli Tiket
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-info text-center">
                                Belum ada event yang tersedia saat ini.
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
