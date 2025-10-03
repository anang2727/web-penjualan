<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pertanian Sejahtera</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Pertanian Sejahtera</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @if (Route::has('login'))
                    @auth
                    <li class="nav-item">
                        <a href="{{ url('/') }}" class="nav-link">Dashboard</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link">Login</a>
                    </li>
                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="nav-link">Register</a>
                    </li>
                    @endif
                    @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="bg-white py-5 shadow-sm">
        <div class="container text-center">
            <h1 class="display-5 fw-bold text-success">Hasil Pertanian Segar Langsung dari Petani</h1>
            <p class="lead text-muted">Mendukung petani lokal, menyediakan kebutuhan pangan sehat untuk keluarga Anda.</p>
            <a href="#produk" class="btn btn-success btn-lg mt-3">Lihat Produk</a>
        </div>
    </header>

    <!-- Produk Section -->
    <section id="produk" class="py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-4">Produk Pertanian Unggulan</h2>
            <div class="row g-4">

                <!-- Produk 1 -->
                <div class="col-md-4">
                    <div class="card shadow-sm h-100">
                        <img src="https://via.placeholder.com/400x250?text=Produk"
                            class="card-img-top" alt="Sayuran Segar">
                        <div class="card-body text-center">
                            <h5 class="card-title">Sayuran Organik</h5>
                            <p class="text-muted">Rp25.000 / kg</p>
                            <a href="#" class="btn btn-success">Tambah ke Keranjang</a>
                        </div>
                    </div>
                </div>

                <!-- Produk 2 -->
                <div class="col-md-4">
                    <div class="card shadow-sm h-100">
                        <img src="https://images.unsplash.com/photo-1621263764502-95bd2f12c1ed?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                            class="card-img-top" alt="Beras Lokal">
                        <div class="card-body text-center">
                            <h5 class="card-title">Beras Premium</h5>
                            <p class="text-muted">Rp60.000 / 5 kg</p>
                            <a href="#" class="btn btn-success">Tambah ke Keranjang</a>
                        </div>
                    </div>
                </div>

                <!-- Produk 3 -->
                <div class="col-md-4">
                    <div class="card shadow-sm h-100">
                        <img src="https://images.unsplash.com/photo-1606788075761-9a4bfc6dff84?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                            class="card-img-top" alt="Buah Segar">
                        <div class="card-body text-center">
                            <h5 class="card-title">Buah Segar</h5>
                            <p class="text-muted">Rp30.000 / kg</p>
                            <a href="#" class="btn btn-success">Tambah ke Keranjang</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p class="mb-0">&copy; 2025 Pertanian Sejahtera. Mendukung Petani Lokal, Mensejahterakan Bangsa.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>