<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Pembelian Tiket') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <h3 class="h5 mb-4 fw-bold">Daftar Transaksi Anda</h3>

                <div class="table-responsive">
                    <table class="table table-hover table-striped border">
                        <thead class="table-light">
                            <tr>
                                <th class="py-3 px-4">Tanggal Pembelian</th>
                                <th class="py-3 px-4">Event</th>
                                <th class="py-3 px-4">Jenis Tiket</th>
                                <th class="py-3 px-4 text-center">Jumlah</th>
                                <th class="py-3 px-4 text-end">Total Harga</th>
                                <th class="py-3 px-4 text-center">Status</th>
                                <th class="py-3 px-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions as $transaction)
                                <tr>
                                    <td class="py-3 px-4">{{ $transaction->created_at->format('d M Y H:i') }}</td>
                                    <td class="py-3 px-4 fw-bold">{{ $transaction->ticketType->event->nama_event }}</td>
                                    <td class="py-3 px-4">{{ $transaction->ticketType->nama_tiket }}</td>
                                    <td class="py-3 px-4 text-center">{{ $transaction->quantity }}</td>
                                    <td class="py-3 px-4 text-end fw-bold text-primary">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                                    <td class="py-3 px-4 text-center">
                                        <span class="badge bg-success">{{ strtoupper($transaction->status) }}</span>
                                    </td>
                                    <td class="py-3 px-4 text-center">
                                        <a href="{{ route('transactions.download', $transaction) }}" class="btn btn-sm btn-primary" title="Download E-Ticket">
                                            <i class="bi bi-download"></i> Download Tiket
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">
                                        Anda belum memiliki transaksi pembelian tiket.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
