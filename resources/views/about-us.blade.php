<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tentang Kami - DakraMart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{asset('assets/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        /* Menggunakan Style Coklat Pastel yang Sama */
        :root {
            --pastel-brown: #B7A19D;
            --pastel-light: #EBE5E4;
            --pastel-dark: #8C7570;
            --pastel-success: #93C47D;
            --pastel-accent: #D3C9C6;
        }

        body {
            background-color: var(--pastel-light) !important;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;

        }

        /* Navbar Styling */
        .bg-primary-custom {
            background-color: var(--pastel-brown) !important;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .btn-nav-custom {
            background-color: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.4);
            color: white;
            transition: all 0.3s;
        }

        .btn-nav-custom:hover {
            background-color: var(--pastel-dark);
            border-color: var(--pastel-dark);
            color: white;
        }

        /* Card Profil Styling */
        .card-profile {
            border-radius: 15px;
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background-color: white;
            overflow: hidden;
        }

        /* Efek Hover pada Card */
        .card-profile:hover {
            transform: translateY(-10px);
            /* Naik sedikit saat di-hover */
            box-shadow: 0 8px 16px rgba(183, 161, 157, 0.6);
            /* Shadow pastel */
        }

        .profile-img-container {
            padding: 20px;
            background-color: var(--pastel-light);
            /* Background header foto */
            text-align: center;
        }

        .profile-img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid var(--pastel-brown);
            background-color: #fff;
        }

        .card-title {
            color: var(--pastel-dark);
            font-weight: bold;
            margin-top: 10px;
        }

        .card-text {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .nim-badge {
            background-color: var(--pastel-brown);
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.85rem;
            display: inline-block;
            margin-top: 5px;
        }

        /* Tombol Navigasi */
        .btn-outline-light:hover {
            background-color: var(--pastel-dark) !important;
            border-color: var(--pastel-dark) !important;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
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

    <!-- Konten Utama -->
    <div class="container my-5">
        <div class="text-center mb-5">
            <h2 style="color: var(--pastel-dark); font-weight: bold;">Tim Pengembang IF7MART</h2>
        </div>

        <div class="row g-4">

            <!-- Anggota 1 -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card card-profile h-100">
                    <div class="profile-img-container">
                        <!-- Ganti src dengan foto asli nanti -->
                        <img src="img/rafael.jpeg" class="profile-img" alt="Foto Anggota">
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title">Rafael Rangga Wijayandi</h5>
                        <span class="nim-badge">NIM: 10123265</span>
                        <p class="card-text mt-3">Frontend Dev</p>
                    </div>
                </div>
            </div>

            <!-- Anggota 2 -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card card-profile h-100">
                    <div class="profile-img-container">
                        <img src="img/zidan.jpeg" class="profile-img" alt="Foto Anggota">
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title">Jidansyah Maulana S.</h5>
                        <span class="nim-badge">NIM: 10123267</span>
                        <p class="card-text mt-3">Frontend Dev</p>
                    </div>
                </div>
            </div>

            <!-- Anggota 3 -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card card-profile h-100">
                    <div class="profile-img-container">
                        <img src="img/hasna.jpeg" class="profile-img" alt="Foto Anggota">
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title">Hasna Nur Maulida </h5>
                        <span class="nim-badge">NIM: 10123258</span>
                        <p class="card-text mt-3">Backend Dev</p>
                    </div>
                </div>
            </div>

            <!-- Anggota 4 -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card card-profile h-100">
                    <div class="profile-img-container">
                        <img src="https://ui-avatars.com/api/?name=Anggota+4&background=D3C9C6&color=fff&size=128" class="profile-img" alt="Foto Anggota">
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title">Nur Azizah Naswa </h5>
                        <span class="nim-badge">NIM: 10123261</span>
                        <p class="card-text mt-3">UI/UX</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="{{asset('assets/bootstrap.bundle.min.js')}}"></script>
</body>

</html>