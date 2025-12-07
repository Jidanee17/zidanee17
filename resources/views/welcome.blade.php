<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IF7MART - Katalog Alat Tulis Kantor</title>

    <!-- Menggunakan Aset Bootstrap yang sama -->
    <link href="{{asset('assets/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        /* --- 1. VARIABEL WARNA (Sama persis dengan barang.blade.php) --- */
        :root {
            --pastel-brown: #B7A19D;
            --pastel-light: #EBE5E4;
            --pastel-dark: #8C7570;
            --pastel-success: #93C47D;
            --pastel-accent: #D3C9C6;
            --pastel-warning: #FFDDAA;
        }

        /* Reset & Body Full Screen */
        body {
            background-color: var(--pastel-light) !important;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* --- 2. NAVBAR STYLING (Persis barang.blade.php) --- */
        .bg-primary-custom {
            background-color: var(--pastel-brown) !important;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        /* Tombol Navigasi Kustom (Transparan) */
        .btn-nav-custom {
            background-color: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.4);
            color: white;
            transition: all 0.3s;
            font-weight: 500;
        }

        .btn-nav-custom:hover {
            background-color: var(--pastel-dark);
            border-color: var(--pastel-dark);
            color: white;
        }

        /* --- 3. HERO SECTION --- */
        .hero {
            background-color: white;
            padding: 60px 20px;
            text-align: center;
            border-bottom: 4px solid var(--pastel-brown);
            margin-bottom: 40px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .hero h1 {
            color: var(--pastel-dark);
            font-weight: bold;
            margin-bottom: 15px;
        }

        .hero p {
            color: #6c757d;
            font-size: 1.2rem;
        }

        /* --- 4. PRODUCT CARD --- */
        .section-title {
            color: var(--pastel-dark);
            font-weight: bold;
            border-left: 5px solid var(--pastel-brown);
            padding-left: 15px;
            margin-bottom: 30px;
        }

        .card-product {
            background: white;
            border: none;
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            height: 100%;
            /* Agar tinggi kartu sama */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .card-product:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(139, 115, 110, 0.2);
        }

        .product-img-wrapper {
            height: 200px;
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            border-bottom: 1px solid #eee;
        }

        .product-img-wrapper img {
            max-height: 80%;
            max-width: 80%;
            object-fit: contain;
        }

        .card-body {
            padding: 20px;
            text-align: center;
        }

        .product-name {
            font-size: 1.1rem;
            font-weight: bold;
            color: #555;
            margin-bottom: 10px;
        }

        .product-desc {
            font-size: 0.9rem;
            color: #888;
            line-height: 1.5;
        }

        /* --- 5. FOOTER --- */
        footer {
            background-color: var(--pastel-brown);
            color: white;
            text-align: center;
            padding: 25px;
            margin-top: auto;
            /* Push footer to bottom */
        }
    </style>
</head>

<body>

    <!-- NAVBAR (Layout Persis Barang/Kasir) -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary-custom py-3 sticky-top">
        <div class="container">
            <span class="navbar-brand">
                <i class="fas fa-shopping-basket me-2"></i>IF7MART
            </span>

            <!-- Divider & Tentang Kami (Mirip layout admin) -->
            <span class="text-white mx-3 d-none d-lg-inline">|</span>
            <a href="{{ route('about.us') }}" class="nav-link text-white fw-bold d-none d-lg-block" style="text-decoration: underline;">
                Tentang Kami
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">

                    <!-- Menu Tentang Kami (Muncul di Mobile) -->
                    <li class="nav-item d-lg-none my-2">
                        <a href="{{ route('about.us') }}" class="nav-link text-white">Tentang Kami</a>
                    </li>

                    <!-- Tombol Login -->
                    <li class="nav-item">
                        <a href="{{ route('Login.index') }}" class="btn btn-nav-custom btn-sm px-4 py-2">
                            <i class="fas fa-sign-in-alt me-2"></i> Login
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <div class="hero">
        <div class="container">
            <h1>Selamat Datang di IF7MART</h1>
            <p>Katalog Lengkap Alat Tulis Kantor ATK Berkualitas dengan Harga Terbaik.</p>
        </div>
    </div>

    <!-- CONTENT AREA -->
    <div class="container mb-5">
        <h3 class="section-title">Katalog Produk Terbaru</h3>

        <!-- GRID SYSTEM BOOTSTRAP: 4 Kolom di Layar Besar (lg), 2 di Tablet (md), 1 di HP -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">

            @php
            $products = [
            [
            'name' => 'Buku Tulis Sidu 58',
            'desc' => 'Buku tulis isi 58 lembar, kertas putih bersih kualitas ekspor.',
            // Menggunakan fungsi asset() untuk memanggil gambar dari folder public/img
            'img' => asset('img/buku-tulis.jpg')
            ],
            [
            'name' => 'Pulpen Standard AE7',
            'desc' => 'Pulpen tinta lancar anti macet. Tersedia Hitam & Biru.',
            'img' => asset('img/pulpen.jpg')
            ],
            [
            'name' => 'Map Kertas Batik',
            'desc' => 'Map penyimpan dokumen motif batik formal untuk kantor.',
            'img' => asset('img/map-batik.jpg')
            ],
            [
            'name' => 'Stapler Max HD-10',
            'desc' => 'Stapler kecil kuat, awet, dan nyaman digenggam.',
            'img' => asset('img/stapler.webp')
            ],
            // --- TAMBAHAN 3 PRODUK BARU + 1 Agar Genap 8 ---
            [
            'name' => 'Kertas HVS A4 70gr',
            'desc' => 'Kertas HVS putih cerah, cocok untuk print dokumen penting.',
            'img' => asset('img/kertas-hvs.jpg')
            ],
            [
            'name' => 'Spidol Boardmarker',
            'desc' => 'Spidol papan tulis hitam, mudah dihapus dan tinta pekat.',
            'img' => asset('img/spidol.jpg')
            ],
            [
            'name' => 'Correction Tape',
            'desc' => 'Tip-x kertas gulung, kering instan dan hasil rapi.',
            'img' => asset('img/correction-tape.jpg.webp')
            ],
            [
            'name' => 'Gunting Kertas Sedang',
            'desc' => 'Gunting baja anti karat dengan pegangan ergonomis.',
            'img' => asset('img/gunting.jpg')
            ],
            ];
            @endphp

            @foreach($products as $item)
            <div class="col">
                <div class="card card-product h-100">
                    <div class="product-img-wrapper">
                        <!-- Icon Placeholder FontAwesome jika gambar gagal load, atau img src -->
                        <img src="{{ $item['img'] }}" alt="{{ $item['name'] }}">
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="product-name">{{ $item['name'] }}</h5>
                        <p class="product-desc flex-grow-1">{{ $item['desc'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>

    <!-- FOOTER -->
    <footer>
        <p class="mb-0">&copy; {{ date('Y') }} IF7MART - Solusi Alat Tulis Kantor Terpercaya.</p>
    </footer>

    <script src="{{asset('assets/bootstrap.bundle.min.js')}}"></script>
</body>

</html>