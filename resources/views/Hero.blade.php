<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pertanian Sejahtera</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
        .hero-bg {
            background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%);
        }
        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .product-card:hover {
            transform: translateY(-5px);
            transition: transform 0.3s ease;
        }
        .badge-stock {
            font-size: 0.75rem;
        }
    </style>
</head>

<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-success sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="#">
                <i class="bi bi-flower1 me-2 fs-4"></i>
                Pertanian Sejahtera
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @if (Route::has('login'))
                    @auth
                    <li class="nav-item">
                        <a href="{{ url('/') }}" class="nav-link text-white fw-semibold">
                            <i class="bi bi-speedometer2 me-1"></i>Dashboard
                        </a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link text-white fw-semibold">
                            <i class="bi bi-box-arrow-in-right me-1"></i>Login
                        </a>
                    </li>
                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="btn btn-light text-success fw-semibold ms-2">
                            <i class="bi bi-person-plus me-1"></i>Register
                        </a>
                    </li>
                    @endif
                    @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero-bg py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 mx-auto text-center">
                    <div class="mb-4">
                        <span class="badge bg-success bg-opacity-75 text-white px-3 py-2 rounded-pill">
                            <i class="bi bi-award-fill me-1"></i>Produk Berkualitas
                        </span>
                    </div>
                    <h1 class="display-4 fw-bold text-success mb-3">
                        Hasil Pertanian Segar<br>Langsung dari Petani
                    </h1>
                    <p class="lead text-secondary mb-4">
                        Mendukung petani lokal, menyediakan kebutuhan pangan sehat untuk keluarga Anda
                    </p>
                    <a href="#produk" class="btn btn-success btn-lg px-5 shadow-sm">
                        <i class="bi bi-bag-check me-2"></i>Lihat Produk
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Features Section -->
    <section class="py-4 bg-white border-bottom">
        <div class="container">
            <div class="row text-center g-4">
                <div class="col-md-4">
                    <div class="d-flex flex-column align-items-center">
                        <div class="bg-success bg-opacity-10 rounded-circle p-3 mb-3">
                            <i class="bi bi-truck text-success fs-2"></i>
                        </div>
                        <h6 class="fw-bold">Pengiriman Cepat</h6>
                        <p class="text-muted small mb-0">Produk segar sampai ke rumah</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex flex-column align-items-center">
                        <div class="bg-success bg-opacity-10 rounded-circle p-3 mb-3">
                            <i class="bi bi-shield-check text-success fs-2"></i>
                        </div>
                        <h6 class="fw-bold">Kualitas Terjamin</h6>
                        <p class="text-muted small mb-0">Langsung dari petani terpercaya</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex flex-column align-items-center">
                        <div class="bg-success bg-opacity-10 rounded-circle p-3 mb-3">
                            <i class="bi bi-cash-coin text-success fs-2"></i>
                        </div>
                        <h6 class="fw-bold">Harga Terbaik</h6>
                        <p class="text-muted small mb-0">Tanpa perantara berlebih</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Produk Section -->
    <section id="produk" class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-dark mb-2">Produk Pertanian Unggulan</h2>
                <p class="text-muted">Pilihan terbaik untuk kebutuhan pangan keluarga Anda</p>
            </div>

            @if ($postingan_dagangans->isEmpty())
            <div class="text-center py-5">
                <div class="bg-light rounded p-5">
                    <i class="bi bi-inbox text-muted" style="font-size: 4rem;"></i>
                    <p class="lead text-muted mt-3 mb-0">Saat ini belum ada postingan dagangan yang aktif.</p>
                    <p class="text-muted">Silakan cek kembali nanti</p>
                </div>
            </div>
            @else
            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 g-4">

                @foreach ($postingan_dagangans as $postingan)
                <div class="col">
                    <div class="card border-0 shadow-sm h-100 product-card">

                        @php
                        $fotoUrl = asset('storage/' . $postingan->foto_postingan);
                        $defaultFoto = 'https://via.placeholder.com/400x300/28a745/ffffff?text=' . urlencode($postingan->stokPengepul->nama_komoditas ?? 'Produk Tani');
                        @endphp

                        <div class="position-relative">
                            <img src="{{ $postingan->foto_postingan ? $fotoUrl : $defaultFoto }}"
                                class="card-img-top" alt="{{ $postingan->judul_postingan }}">
                            <span class="position-absolute top-0 end-0 m-2 badge bg-success">
                                <i class="bi bi-star-fill"></i> Segar
                            </span>
                        </div>

                        <div class="card-body d-flex flex-column">
                            <h6 class="card-title text-success fw-bold mb-2">
                                {{ Str::limit($postingan->judul_postingan, 35) }}
                            </h6>

                            <div class="mb-2">
                                <span class="badge bg-light text-dark border badge-stock">
                                    <i class="bi bi-tag-fill text-success"></i> 
                                    {{ $postingan->stokPengepul->nama_komoditas ?? 'N/A' }}
                                </span>
                            </div>

                            <div class="mb-3">
                                <h5 class="text-success fw-bold mb-1">
                                    Rp{{ number_format($postingan->harga_jual_satuan, 0, ',', '.') }}
                                </h5>
                                <small class="text-muted">per {{ $postingan->satuan }}</small>
                            </div>

                            <div class="border-top pt-2 mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <small class="text-muted">
                                        <i class="bi bi-box-seam text-success"></i> Stok:
                                    </small>
                                    <small class="fw-semibold">
                                        {{ number_format($postingan->kuantitas_dijual, 0, ',', '.') }} {{ $postingan->satuan }}
                                    </small>
                                </div>
                                <div class="d-flex align-items-start">
                                    <i class="bi bi-geo-alt-fill text-success me-1 mt-1" style="font-size: 0.8rem;"></i>
                                    <small class="text-muted text-truncate">{{ $postingan->lokasi_stok }}</small>
                                </div>
                            </div>

                            <div class="mt-auto">
                                @guest
                                <a href="{{ route('login') }}" class="btn btn-outline-success w-100">
                                    Beli
                                </a>
                                @else
                                <a href="{{ url('/order/' . $postingan->id) }}" class="btn btn-success w-100">
                                    <i class="bi bi-cart-plus me-1"></i>Tambah ke Keranjang
                                </a>
                                @endguest
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
            @endif
        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-success text-white py-5">
        <div class="container text-center">
            <h3 class="fw-bold mb-3">Ingin Menjual Hasil Pertanian Anda?</h3>
            <p class="lead mb-4">Bergabunglah dengan kami dan jangkau lebih banyak pembeli</p>
            @guest
            <a href="{{ route('register') }}" class="btn btn-light btn-lg text-success fw-semibold px-5">
                <i class="bi bi-person-plus-fill me-2"></i>Daftar Sekarang
            </a>
            @endguest
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white pt-5 pb-3">
        <div class="container">
            <div class="row mb-4">
                <div class="col-md-4 mb-3">
                    <h5 class="fw-bold mb-3">
                        <i class="bi bi-flower1 me-2"></i>Pertanian Sejahtera
                    </h5>
                    <p class="text-white-50 small">
                        Menghubungkan petani dengan konsumen untuk hasil pertanian segar dan berkualitas.
                    </p>
                </div>
                <div class="col-md-4 mb-3">
                    <h6 class="fw-bold mb-3">Kontak</h6>
                    <ul class="list-unstyled small text-white-50">
                        <li class="mb-2"><i class="bi bi-envelope me-2"></i>info@pertaniansejahtera.id</li>
                        <li class="mb-2"><i class="bi bi-telephone me-2"></i>+62 821 xxxx xxxx</li>
                        <li><i class="bi bi-geo-alt me-2"></i>Medan, Sumatera Utara</li>
                    </ul>
                </div>
                <div class="col-md-4 mb-3">
                    <h6 class="fw-bold mb-3">Ikuti Kami</h6>
                    <div class="d-flex gap-2">
                        <a href="#" class="btn btn-outline-light btn-sm rounded-circle">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="#" class="btn btn-outline-light btn-sm rounded-circle">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="#" class="btn btn-outline-light btn-sm rounded-circle">
                            <i class="bi bi-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>
            <hr class="border-secondary">
            <p class="text-center text-white-50 small mb-0">
                &copy; 2025 Pertanian Sejahtera. Mendukung Petani Lokal, Mensejahterakan Bangsa.
            </p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>