<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Laporan Penjualan Tiket') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Summary Statistics -->
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm bg-primary text-white">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2 opacity-75">Total Tiket Terjual</h6>
                            <h3 class="card-title mb-0 fw-bold">{{ number_format($totalTiketTerjual) }} Tiket</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm bg-success text-white">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2 opacity-75">Total Pendapatan</h6>
                            <h3 class="card-title mb-0 fw-bold">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Export Buttons & Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="h5 mb-0 fw-bold">Detail Transaksi</h3>
                    <div class="d-flex gap-2">
                        <a href="{{ route('reports.pdf') }}" class="btn btn-danger btn-sm">
                            <i class="bi bi-file-pdf"></i> Export PDF
                        </a>
                        <a href="{{ route('reports.excel') }}" class="btn btn-success btn-sm">
                            <i class="bi bi-file-excel"></i> Export Excel
                        </a>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover table-striped border">
                        <thead class="table-light">
                            <tr>
                                <th class="py-3 px-4">No. Transaksi</th>
                                <th class="py-3 px-4">Nama User</th>
                                <th class="py-3 px-4">Event</th>
                                <th class="py-3 px-4">Jenis Tiket</th>
                                <th class="py-3 px-4 text-center">Qty</th>
                                <th class="py-3 px-4 text-end">Harga Satuan</th>
                                <th class="py-3 px-4 text-end">Total</th>
                                <th class="py-3 px-4">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions as $transaction)
                                <tr>
                                    <td class="py-3 px-4">#{{ $transaction->id }}</td>
                                    <td class="py-3 px-4">{{ $transaction->user->name }}</td>
                                    <td class="py-3 px-4 fw-bold">{{ $transaction->ticketType->event->nama_event }}</td>
                                    <td class="py-3 px-4">{{ $transaction->ticketType->nama_tiket }}</td>
                                    <td class="py-3 px-4 text-center">{{ $transaction->quantity }}</td>
                                    <td class="py-3 px-4 text-end">Rp {{ number_format($transaction->ticketType->harga, 0, ',', '.') }}</td>
                                    <td class="py-3 px-4 text-end fw-bold text-primary">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                                    <td class="py-3 px-4">{{ $transaction->created_at->format('d M Y H:i') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4 text-muted">Belum ada transaksi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot class="table-secondary fw-bold">
                            <tr>
                                <td colspan="6" class="py-3 px-4 text-end">TOTAL KESELURUHAN:</td>
                                <td class="py-3 px-4 text-end text-primary">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</td>
                                <td class="py-3 px-4"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
