<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Riwayat Transaksi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="{{asset('assets/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        /* Tema Warna Pastel - Konsisten dengan Halaman Kasir */
        :root {
            --pastel-brown: #B7A19D;
            /* Warna Utama */
            --pastel-light: #FDFBF7;
            /* Background Halaman Lebih Terang */
            --pastel-dark: #8C7570;
            /* Warna Aksen/Hover */
            --pastel-success: #A3C9A8;
            /* Hijau Pastel */
            --pastel-card-bg: #FFFFFF;
            /* Warna Card Putih Bersih */
        }

        body {
            background-color: var(--pastel-light) !important;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Navbar Styling */
        .bg-primary-custom {
            background-color: var(--pastel-brown) !important;
            box-shadow: 0 2px 10px rgba(139, 115, 110, 0.2);
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

        /* Card Info Styling */
        .info-card {
            border: none;
            border-radius: 12px;
            color: white;
            transition: transform 0.2s;
            overflow: hidden;
            position: relative;
        }

        .info-card:hover {
            transform: translateY(-5px);
        }

        .info-card-profit {
            background: linear-gradient(135deg, var(--pastel-success), #8FB996);
        }

        .info-card-total {
            background: linear-gradient(135deg, var(--pastel-brown), var(--pastel-dark));
        }

        .info-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 3rem;
            opacity: 0.2;
        }

        /* Table Styling */
        .card-table {
            border: none;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }

        .table-custom thead {
            background-color: var(--pastel-brown);
            color: white;
        }

        .table-custom th {
            border-bottom: none;
            /* PADDING DIPERKECIL (Vertical 12px, Horizontal 10px) */
            padding: 12px 10px;
            font-weight: 600;
        }

        .table-custom td {
            /* PADDING DIPERKECIL (Vertical 10px, Horizontal 10px) */
            padding: 10px 10px;
            border-bottom: 1px solid #eee;
        }

        .table-custom tbody tr:hover {
            background-color: #f9f6f5;
        }

        /* Button Action */
        .btn-action {
            background-color: var(--pastel-dark);
            color: white;
            border: none;
            padding: 5px 12px;
            border-radius: 6px;
            font-size: 0.85rem;
            transition: all 0.2s;
        }

        .btn-action:hover {
            background-color: #6d5b57;
            color: white;
        }

        .badge-soft {
            background-color: rgba(183, 161, 157, 0.15);
            color: var(--pastel-dark);
            padding: 5px 10px;
            border-radius: 50px;
            font-size: 0.8rem;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary-custom py-3">
        <div class="container">
            <span class="navbar-brand">
                <i class="fas fa-shopping-basket me-2"></i>IF7MART
            </span>


            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item me-3 text-white">
                        <i class="fas fa-user-circle me-1"></i> Hai, Admin
                    </li>
                    <li class="nav-item">
                        <a href="{{route('kasir.index')}}" class="btn btn-nav-custom btn-sm mx-1">
                            <i class="fas fa-cash-register me-1"></i> Transaksi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('barang.index')}}" class="btn btn-nav-custom btn-sm mx-1">
                            <i class="fas fa-box-open me-1"></i> Barang
                        </a>
                    </li>
                    <li class="nav-item">
                        <!-- Sesuaikan route logout jika berbeda -->
                        <a href="{{ route('login.logout') }}" class="btn btn-nav-custom btn-sm mx-1">
                            <i class="fas fa-sign-out-alt me-1"></i> Keluar
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Konten Utama -->
    <div class="container my-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold text-secondary"><i class="fas fa-history me-2"></i>Riwayat Transaksi</h4>
            <div class="text-muted small">
                Pantau penjualan harian Anda di sini
            </div>
        </div>

        <!-- Ringkasan Info -->
        <div class="row mb-4">
            <div class="col-md-6 mb-3">
                <div class="card p-4 info-card info-card-profit">
                    <div class="d-flex flex-column">
                        <span class="opacity-75 mb-1">Total Penjualan Kotor</span>
                        <h3 class="fw-bold mb-0">Rp {{ number_format($total_penjualan ?? 0, 0, ',', '.') }}</h3>
                    </div>
                    <i class="fas fa-chart-line info-icon"></i>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="card p-4 info-card info-card-total">
                    <div class="d-flex flex-column">
                        <span class="opacity-75 mb-1">Jumlah Transaksi</span>
                        <h3 class="fw-bold mb-0">{{ $total_transaksi_count ?? 0 }} <span class="fs-6 fw-normal">Transaksi</span></h3>
                    </div>
                    <i class="fas fa-shopping-bag info-icon"></i>
                </div>
            </div>
        </div>

        <!-- Tabel Transaksi -->
        <div class="card card-table shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-custom align-middle mb-0">
                        <thead>
                            <tr>
                                <!-- UPDATE WIDTH: Total tetap 100% -->
                                <th class="ps-4" width="5%">No</th>

                                <!-- Memecah Kolom Kode & Tanggal -->
                                <th class="text-center" width="20%">Kode Transaksi</th>
                                <th class="text-center" width="15%">Tanggal</th>

                                <th class="text-end" width="20%">Total</th>
                                <th class="text-end" width="20%">Total Akhir</th>
                                <th class="text-center" width="20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($transaksis as $index => $transaksi)
                            @php
                            // Menghitung total akhir jika kolom total_akhir belum ada di DB
                            // total_akhir = total - diskon
                            $total_akhir = $transaksi->total_akhir ?? ($transaksi->total - ($transaksi->diskon ?? 0));
                            @endphp
                            <tr>
                                <td class="ps-4 text-muted">{{ $loop->iteration }}</td>

                                <!-- Kolom Kode Transaksi -->
                                <td class="text-center">
                                    <span class="fw-bold text-dark">{{ $transaksi->kode_transaksi ?? 'TRX-'.$transaksi->id }}</span>
                                </td>

                                <!-- Kolom Tanggal -->
                                <td class="text-center small text-muted">
                                    <div><i class="far fa-clock me-1"></i>{{ $transaksi->tanggal->format('d M Y') }}</div>
                                    <div>{{ $transaksi->tanggal->format('H:i') }}</div>
                                </td>

                                <td class="text-end text-muted">
                                    Rp {{ number_format($transaksi->total, 0, ',', '.') }}
                                </td>
                                <td class="text-end fw-bold text-success">
                                    Rp {{ number_format($total_akhir, 0, ',', '.') }}
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('kasir.cetak', $transaksi->id) }}" class="btn btn-action" title="Cetak Struk">
                                        <i class="fas fa-print me-1"></i> Cetak
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <!-- Colspan disesuaikan jadi 6 karena ada kolom baru -->
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="fas fa-inbox fa-3x mb-3 opacity-25"></i>
                                    <p>Belum ada riwayat transaksi.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Pagination jika diperlukan -->
            @if(method_exists($transaksis, 'links'))
            <div class="card-footer bg-white border-0 py-3">
                {{ $transaksis->links() }}
            </div>
            @endif
        </div>
    </div>

    <script src="{{asset('assets/bootstrap.bundle.min.js')}}"></script>
</body>

</html>