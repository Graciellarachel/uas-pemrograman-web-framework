<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Message -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }}</h3>
                    <p class="text-gray-600">Temukan event menarik dan kelola pembelian tiket Anda dengan mudah.</p>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="row g-4 mb-6">
                @php
                    $totalTransactions = Auth::user()->transactions()->count();
                    $totalTickets = Auth::user()->transactions()->sum('quantity');
                    $totalSpent = Auth::user()->transactions()->sum('total_price');
                    $upcomingEvents = \App\Models\Event::where('tanggal_event', '>=', now())->count();
                @endphp

                <div class="col-md-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="bi bi-ticket-perforated" style="font-size: 2rem; color: #667eea;"></i>
                            </div>
                            <h3 class="h4 fw-bold mb-1">{{ $totalTickets }}</h3>
                            <p class="text-muted small mb-0">Total Tiket Dibeli</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="bi bi-receipt" style="font-size: 2rem; color: #f093fb;"></i>
                            </div>
                            <h3 class="h4 fw-bold mb-1">{{ $totalTransactions }}</h3>
                            <p class="text-muted small mb-0">Total Transaksi</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="bi bi-wallet2" style="font-size: 2rem; color: #4facfe;"></i>
                            </div>
                            <h3 class="h4 fw-bold mb-1">Rp {{ number_format($totalSpent, 0, ',', '.') }}</h3>
                            <p class="text-muted small mb-0">Total Pengeluaran</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="bi bi-calendar-event" style="font-size: 2rem; color: #43e97b;"></i>
                            </div>
                            <h3 class="h4 fw-bold mb-1">{{ $upcomingEvents }}</h3>
                            <p class="text-muted small mb-0">Event Tersedia</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Transactions -->
            @if($totalTransactions > 0)
                @php
                    $recentTransactions = Auth::user()->transactions()
                        ->with(['ticketType.event'])
                        ->latest()
                        ->take(5)
                        ->get();
                @endphp

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                    <div class="p-6">
                        <h4 class="font-bold mb-4">Transaksi Terbaru</h4>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Event</th>
                                        <th>Jenis Tiket</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-end">Total</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentTransactions as $transaction)
                                        <tr>
                                            <td class="fw-bold">{{ $transaction->ticketType->event->nama_event }}</td>
                                            <td>{{ $transaction->ticketType->nama_tiket }}</td>
                                            <td class="text-center">{{ $transaction->quantity }}</td>
                                            <td class="text-end">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                                            <td>{{ $transaction->created_at->format('d M Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
