<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Message -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-2">Dashboard Administrator</h3>
                    <p class="text-gray-600">Kelola sistem pembelian tiket event dengan mudah dan efisien.</p>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="row g-4 mb-6">
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="bi bi-people-fill" style="font-size: 2.5rem; color: #667eea;"></i>
                            </div>
                            <h3 class="h3 fw-bold mb-1">{{ $totalUsers }}</h3>
                            <p class="text-muted small mb-0">Total User</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="bi bi-calendar-event-fill" style="font-size: 2.5rem; color: #f093fb;"></i>
                            </div>
                            <h3 class="h3 fw-bold mb-1">{{ $totalEvents }}</h3>
                            <p class="text-muted small mb-0">Total Event</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="bi bi-ticket-perforated-fill" style="font-size: 2.5rem; color: #4facfe;"></i>
                            </div>
                            <h3 class="h3 fw-bold mb-1">{{ $totalTicketsSold }}</h3>
                            <p class="text-muted small mb-0">Tiket Terjual</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="bi bi-cash-stack" style="font-size: 2.5rem; color: #43e97b;"></i>
                            </div>
                            <h3 class="h4 fw-bold mb-1">Rp {{ number_format($totalSales, 0, ',', '.') }}</h3>
                            <p class="text-muted small mb-0">Total Penjualan</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chart Section -->
            <div class="row g-4 mb-6">
                <div class="col-md-8">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-4">Distribusi Penjualan per Event</h5>
                            <div style="max-width: 500px; margin: 0 auto;">
                                <canvas id="salesChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-4">Ringkasan</h5>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-muted small">Jenis Tiket:</span>
                                    <span class="fw-bold">{{ $totalTicketTypes }}</span>
                                </div>
                                <div class="progress" style="height: 5px;">
                                    <div class="progress-bar bg-primary" style="width: 100%"></div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-muted small">Tiket Terjual:</span>
                                    <span class="fw-bold">{{ $totalTicketsSold }}</span>
                                </div>
                                <div class="progress" style="height: 5px;">
                                    <div class="progress-bar bg-success" style="width: 85%"></div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-muted small">Total Event:</span>
                                    <span class="fw-bold">{{ $totalEvents }}</span>
                                </div>
                                <div class="progress" style="height: 5px;">
                                    <div class="progress-bar bg-info" style="width: 70%"></div>
                                </div>
                            </div>
                            <hr>
                            <div class="text-center mt-4">
                                <a href="{{ route('reports.index') }}" class="btn btn-primary btn-sm w-100">
                                    <i class="bi bi-file-earmark-text"></i> Lihat Laporan Lengkap
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Transactions -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h5 class="fw-bold mb-4">Transaksi Terbaru</h5>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>User</th>
                                    <th>Event</th>
                                    <th>Tiket</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-end">Total</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentTransactions as $transaction)
                                    <tr>
                                        <td>#{{ $transaction->id }}</td>
                                        <td>{{ $transaction->user->name }}</td>
                                        <td class="fw-bold">{{ $transaction->ticketType->event->nama_event }}</td>
                                        <td>{{ $transaction->ticketType->nama_tiket }}</td>
                                        <td class="text-center">{{ $transaction->quantity }}</td>
                                        <td class="text-end">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                                        <td>{{ $transaction->created_at->format('d M Y') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted">Belum ada transaksi.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('salesChart').getContext('2d');
        
        // Calculate total for percentage
        const salesData = @json($eventSales);
        const total = salesData.reduce((a, b) => a + b, 0);
        
        const salesChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: @json($eventNames),
                datasets: [{
                    label: 'Penjualan',
                    data: salesData,
                    backgroundColor: [
                        'rgba(102, 126, 234, 0.8)',
                        'rgba(240, 147, 251, 0.8)',
                        'rgba(79, 172, 254, 0.8)',
                        'rgba(67, 233, 123, 0.8)',
                        'rgba(254, 158, 97, 0.8)',
                        'rgba(255, 107, 107, 0.8)',
                    ],
                    borderColor: '#fff',
                    borderWidth: 3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            padding: 15,
                            font: {
                                size: 12
                            },
                            generateLabels: function(chart) {
                                const data = chart.data;
                                if (data.labels.length && data.datasets.length) {
                                    return data.labels.map((label, i) => {
                                        const value = data.datasets[0].data[i];
                                        const percentage = ((value / total) * 100).toFixed(1);
                                        return {
                                            text: `${label} (${percentage}%)`,
                                            fillStyle: data.datasets[0].backgroundColor[i],
                                            hidden: false,
                                            index: i
                                        };
                                    });
                                }
                                return [];
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const value = context.parsed;
                                const percentage = ((value / total) * 100).toFixed(1);
                                return `Rp ${value.toLocaleString('id-ID')} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>
