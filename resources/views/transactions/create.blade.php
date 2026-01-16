<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Konfirmasi Pembelian Tiket') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-lg-5">
                    <h5 class="card-title mb-4 border-bottom pb-3">Detail Pembelian</h5>
                    
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('transactions.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4 p-3 bg-light rounded">
                            <h6 class="fw-bold">{{ $event->nama_event }}</h6>
                            <p class="mb-0 small text-muted">{{ \Carbon\Carbon::parse($event->tanggal_event)->format('d F Y') }} - {{ $event->lokasi }}</p>
                        </div>

                        <div class="mb-4">
                            <label for="ticket_type_id" class="form-label fw-bold">Pilih Jenis Tiket <span class="text-danger">*</span></label>
                            <select name="ticket_type_id" id="ticket_type_id" class="form-select @error('ticket_type_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Tiket --</option>
                                @foreach($ticketTypes as $ticket)
                                    <option value="{{ $ticket->id }}" 
                                            data-price="{{ $ticket->harga }}"
                                            {{ request('ticket_type_id') == $ticket->id ? 'selected' : '' }}>
                                        {{ $ticket->nama_tiket }} - Rp {{ number_format($ticket->harga, 0, ',', '.') }} (Stok: {{ $ticket->stok }})
                                    </option>
                                @endforeach
                            </select>
                            @error('ticket_type_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="quantity" class="form-label fw-bold">Jumlah Tiket <span class="text-danger">*</span></label>
                            <input type="number" name="quantity" id="quantity" min="1" value="1" 
                                   class="form-control @error('quantity') is-invalid @enderror" required>
                            @error('quantity') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="alert alert-info">
                            <strong>Catatan:</strong> Pastikan jumlah tiket yang Anda beli sesuai kebutuhan. Stok akan langsung berkurang setelah pembelian.
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                            <a href="{{ route('user.events.show', $event) }}" class="btn btn-outline-secondary px-4">Batal</a>
                            <button type="submit" class="btn btn-primary px-5 fw-bold">Konfirmasi Pembelian</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
