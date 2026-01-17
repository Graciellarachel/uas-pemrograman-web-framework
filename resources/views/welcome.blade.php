<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'TicketBox') }} - Sistem Tiket Event Online</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
    body {
        font-family: 'Figtree', sans-serif;
    }

    .hero-section {
        background-color: #667eea;
        color: white;
        padding: 100px 0;
        min-height: 500px;
        display: flex;
        align-items: center;
    }

    .feature-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
        height: 100%;
    }

    .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .feature-icon {
        font-size: 3rem;
        color: #667eea;
        margin-bottom: 1rem;
    }

    .navbar-brand img {
        height: 40px;
    }

    .btn-custom {
        background: white;
        color: #667eea;
        font-weight: 600;
        padding: 12px 30px;
        border-radius: 50px;
        transition: all 0.3s ease;
    }

    .btn-custom:hover {
        background: #f8f9fa;
        transform: scale(1.05);
        color: #667eea;
    }
    </style>
</head>

<body>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 text-center">
                    <h1 class="display-4 fw-bold mb-4">Beli Tiket Event Favoritmu dengan Mudah</h1>
                    <p class="lead mb-4">Platform terpercaya untuk membeli tiket event, konser, seminar, dan acara
                        lainnya secara online.</p>
                    @auth
                    <a href="{{ route('user.events.index') }}" class="btn btn-custom btn-lg">
                        <i class="bi bi-calendar-event me-2"></i>Jelajahi Event
                    </a>
                    @else
                    <a href="{{ route('register') }}" class="btn btn-custom btn-lg">
                        <i class="bi bi-rocket-takeoff me-2"></i>Mulai Sekarang
                    </a>
                    @endauth
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Kenapa Memilih TicketBox?</h2>
                <p class="text-muted">Solusi lengkap untuk kebutuhan tiket event Anda</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="card feature-card shadow-sm p-4 text-center">
                        <div class="feature-icon">
                            <i class="bi bi-ticket-perforated-fill"></i>
                        </div>
                        <h5 class="fw-bold">Beli Tiket Online</h5>
                        <p class="text-muted">Beli tiket kapan saja, dimana saja dengan mudah dan cepat</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card feature-card shadow-sm p-4 text-center">
                        <div class="feature-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h5 class="fw-bold">Pembayaran Aman</h5>
                        <p class="text-muted">Transaksi terjamin aman dengan sistem pembayaran terpercaya</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card feature-card shadow-sm p-4 text-center">
                        <div class="feature-icon">
                            <i class="bi bi-phone"></i>
                        </div>
                        <h5 class="fw-bold">Tiket Digital</h5>
                        <p class="text-muted">Akses tiket digital Anda langsung dari smartphone</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card feature-card shadow-sm p-4 text-center">
                        <div class="feature-icon">
                            <i class="bi bi-graph-up"></i>
                        </div>
                        <h5 class="fw-bold">Kelola Event</h5>
                        <p class="text-muted">Fitur lengkap untuk admin mengelola event dan laporan</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container text-center">
            <p class="mb-0">&copy; {{ date('Y') }} TicketBox. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>