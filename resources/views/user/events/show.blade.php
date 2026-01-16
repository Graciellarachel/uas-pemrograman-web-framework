<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $event->nama_event }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Event Info -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-4">
                <h3 class="h4 fw-bold mb-3">Informasi Event</h3>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($event->tanggal_event)->format('d F Y') }}</p>
                        <p><strong>Lokasi:</strong> {{ $event->lokasi }}</p>
                    </div>
                    <div class="col-md-6">
                        @if($event->deskripsi)
                            <p><strong>Deskripsi:</strong></p>
                            <p class="text-muted">{{ $event->deskripsi }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Available Tickets -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="h4 fw-bold mb-4">Pilih Jenis Tiket</h3>
                
                @if($event->ticketTypes->count() > 0)
                    <div class="row g-3">
                        @foreach($event->ticketTypes as $ticket)
                            <div class="col-md-6">
                                <div class="card border">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <h5 class="card-title mb-0">{{ $ticket->nama_tiket }}</h5>
                                            <span class="badge bg-success">Stok: {{ $ticket->stok }}</span>
                                        </div>
                                        <p class="h5 text-primary mb-3">Rp {{ number_format($ticket->harga, 0, ',', '.') }}</p>
                                        <a href="{{ route('transactions.create', $event) }}?ticket_type_id={{ $ticket->id }}" 
                                           class="btn btn-primary w-100">
                                            Beli Tiket Ini
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-warning">
                        Maaf, tiket untuk event ini sudah habis.
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
