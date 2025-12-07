<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Transaksi - DakraMart</title>
  <link href="{{asset('assets/bootstrap.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <style>
    /* Variabel Warna Coklat Pastel Kustom */
    :root {
      --pastel-brown: #B7A19D;
      --pastel-light: #EBE5E4;
      --pastel-dark: #8C7570;
      --pastel-success: #93C47D;
      --pastel-accent: #D3C9C6;
      --pastel-warning: #FFDDAA;
    }

    /* 1. Background Halaman Penuh */
    body {
      background-color: var(--pastel-light) !important;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* 2. Navbar & Header */
    .bg-primary-custom {
      background-color: var(--pastel-brown) !important;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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

    /* Tombol Navigasi Kustom */
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

    /* 3. Tombol Kustom */
    .btn-primary {
      background-color: var(--pastel-brown);
      border-color: var(--pastel-brown);
    }

    .btn-primary:hover,
    .btn-primary:focus {
      background-color: var(--pastel-dark) !important;
      border-color: var(--pastel-dark) !important;
    }

    .btn-success {
      background-color: var(--pastel-success);
      border-color: var(--pastel-success);
    }

    .btn-success:hover,
    .btn-success:focus {
      background-color: #7AA865 !important;
      border-color: #7AA865 !important;
    }

    .btn-danger {
      background-color: #E06666;
      border-color: #E06666;
    }

    .btn-danger:hover {
      background-color: #B54A4A !important;
      border-color: #B54A4A !important;
    }

    /* 4. Card & Fokus Input */
    .card {
      border-radius: 12px;
      /* Disesuaikan dengan desain barang */
      border: none;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    .form-control:focus {
      border-color: var(--pastel-brown);
      box-shadow: 0 0 0 0.25rem rgba(183, 161, 157, 0.25);
    }

    /* --- Desain Tabel Baru (Sesuai barang.blade.php) --- */
    .table-wrapper {
      border-radius: 12px;
      overflow: hidden;
      border: 1px solid var(--pastel-dark);
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .table-custom {
      margin-bottom: 0;
      border-collapse: collapse;
    }

    .table-custom thead th {
      background-color: var(--pastel-brown);
      color: white;
      border: none;
      padding: 12px;
      vertical-align: middle;
    }

    .table-custom tbody td {
      border-bottom: 1px solid #e0e0e0;
      padding: 12px;
      vertical-align: middle;
    }

    .table-custom tbody tr:last-child td {
      border-bottom: none;
    }

    /* --- Sidebar & Pembayaran --- */
    .sticky-sidebar {
      position: sticky;
      top: 20px;
    }

    .total-display-card {
      background-color: var(--pastel-accent);
      color: white;
      text-align: center;
      margin-bottom: 1rem;
      border-radius: 10px;
    }

    .total-amount {
      font-size: 2.5rem;
      font-weight: bold;
    }

    .input-padded-end {
      padding-right: 1rem !important;
    }
  </style>
</head>

<body>

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
          <!-- Tombol Menu -->
          <li class="nav-item">
            <a href="{{route('history.index')}}" class="btn btn-nav-custom btn-sm mx-1"> <i class="fas fa-history me-1"></i> Riwayat
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('barang.index')}}" class="btn btn-nav-custom btn-sm mx-1">
              <i class="fas fa-box-open me-1"></i> Barang
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('login.logout') }}" class="btn btn-nav-custom btn-sm mx-1">
              <i class="fas fa-sign-out-alt me-1"></i> Keluar
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container my-4">
    <h4 class="mb-4" style="color: var(--pastel-dark); font-weight: bold;"><i class="fas fa-cash-register me-2"></i> Transaksi Penjualan</h4>

    <div class="row">

      <div class="col-md-8">
        <div class="card p-3 shadow-sm mb-4">
          <h5 class="mb-3 ps-2" style="color: var(--pastel-dark); font-weight: bold;">Keranjang Belanja</h5>
          <!-- Menggunakan Wrapper Tabel Baru -->
          <div class="table-wrapper">
            <table class="table table-striped align-middle table-custom">
              <thead class="text-center">
                <tr>
                  <th>No</th>
                  <th style="text-align: left;">Nama Barang</th>
                  <th>Harga</th>
                  <th>Diskon</th>
                  <th>Jumlah</th>
                  <th class="text-end">Subtotal</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($cart as $i => $item)
                <tr>
                  <td class="text-center">{{ $loop->iteration }}</td>
                  <td class="fw-bold text-muted">{{ $item['nama'] }}</td>
                  <td class="text-center">Rp {{ number_format($item['harga']) }}</td>

                  <td class="text-center">
                    {{-- Menggunakan null coalescing operator (?? 0) untuk keamanan data --}}
                    @if(isset($item['diskon']) && $item['diskon'] > 0)
                    <span class="badge bg-warning text-dark">{{ $item['diskon'] }}%</span>
                    @else
                    <span class="text-muted">-</span>
                    @endif
                  </td>

                  <td class="text-center">{{ $item['jumlah'] }}</td>
                  <td class="text-end">Rp {{ number_format($item['subtotal']) }}</td>
                  <td class="text-center">
                    <form action="{{ route('kasir.hapus', $i) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger btn-sm" title="Hapus"><i class="fas fa-trash-alt"></i></button>
                    </form>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="7" class="text-center py-4 text-muted">
                    <i class="fas fa-shopping-cart fa-2x mb-3"></i><br>
                    Belum Ada Barang di Keranjang.
                  </td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="sticky-sidebar">

          <div class="card p-3 shadow-sm mb-4">
            <h5 class="mb-3" style="color: var(--pastel-dark); font-weight: bold;"><i class="fas fa-plus-circle me-1"></i> Tambah Barang</h5>
            <form action="{{ route('kasir.add') }}" method="POST">
              @csrf
              <div class="mb-3">
                <label for="barang" class="form-label">Pilih Barang</label>
                <select class="form-select" id="barang" name="barang" required>
                  <option selected disabled>Pilih barang...</option>
                  @foreach ($barang as $item)
                  <!-- Menampilkan Info Harga dan Diskon di Dropdown -->
                  <option value="{{ $item->id }}">
                    {{ $item->nama }}
                    (Rp {{ number_format($item->harga) }})
                    @if($item->diskon > 0) [Disc {{ $item->diskon }}%] @endif
                  </option>
                  @endforeach
                </select>
              </div>
              <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah</label>
                <input type="number" class="form-control" id="jumlah" name="jumlah" min="1" value="1" required>
                <small id="stokMessage" style="margin-top:8px;color:red; display:none;">
                  Jumlah melebihi stok yang tersedia!
                </small>

              </div>
              <button type="submit" class="btn btn-success w-100 mt-2" id="tambahButton" disabled>
                <i class="fas fa-cart-plus me-1"></i> Tambah ke Keranjang
              </button>
            </form>
          </div>

          <div class="total-display-card p-3 shadow-sm">
            <small class="text-white-50">Total Belanja</small>
            <div class="total-amount">
              Rp {{ number_format($total) }}
            </div>
          </div>

          <div class="card p-4 shadow-sm">
            <h5 class="mb-3" style="color: var(--pastel-dark); font-weight: bold;"><i class="fas fa-credit-card me-2"></i> Pembayaran</h5>
            <form action="{{ route('kasir.store') }}" method="POST">
              @csrf
              <input type="hidden" name="total_harga" id="InputTotal" value="{{ $total }}">

              <div class="mb-3">
                <label class="form-label">Uang Dibayar</label>
                <div class="input-group">
                  <span class="input-group-text bg-light">Rp</span>
                  <input type="number" class="form-control text-center form-control-lg input-padded-end" id="InputBayar" name="bayar" placeholder="0" required>
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label">Kembalian</label>
                <input type="text" class="form-control text-end form-control-lg bg-light input-padded-end" id="displayKembalian" value="Rp 0" readonly>
                <input type="hidden" name="kembalian" id="InputKembalian">
              </div>

              <div class="d-grid gap-2 mt-4">
                <button type="submit" class="btn btn-primary btn-lg" id="btnSimpan" disabled>
                  <i class="fas fa-check-circle me-2"></i> Selesai
                </button>
              </div>
            </form>
          </div>

        </div>
      </div>
    </div>
  </div>

  @php
  $stokData = $barang->mapWithKeys(function($b) {
  return [$b->id => ['stok' => $b->stok]];
  });
  @endphp
  <script src="{{asset('assets/bootstrap.bundle.min.js')}}"></script>
  <script>
    function showStokMessage() {
      const msg = document.getElementById('stokMessage');
      msg.style.display = 'block';

      setTimeout(() => {
        msg.style.display = 'none';
      }, 1000); // hilang setelah 1 detik
    }


    // =======================================================
    // LOGIKA PENCEGAHAN OVERSELLING (STOCK VALIDATION)
    // =======================================================

    // PERBAIKAN: Sintaks Blade dirapikan ke satu baris tanpa spasi berlebih
    const stokData = @json($stokData);


    const barangSelect = document.getElementById('barang');
    const jumlahInput = document.getElementById('jumlah');
    const tambahButton = document.getElementById('tambahButton');

    const validateStock = () => {
      const selectedId = barangSelect.value;

      // Ambil stok dari data JSON
      const stokTersedia = stokData[selectedId]?.stok ?? 0;
      let jumlahBeli = parseInt(jumlahInput.value) || 0;

      jumlahInput.setAttribute('max', stokTersedia);
      jumlahInput.setAttribute('min', 1);

      if (!selectedId || stokTersedia <= 0) {
        jumlahInput.value = 1;
        jumlahInput.disabled = true;
        tambahButton.disabled = true;
        return;
      }

      jumlahInput.disabled = false;

      if (jumlahBeli > stokTersedia) {
        jumlahInput.value = stokTersedia;
        jumlahBeli = stokTersedia;
        showStokMessage();
      }

      tambahButton.disabled = (
        jumlahBeli < 1 ||
        jumlahBeli > stokTersedia
      );
    };


    barangSelect.addEventListener('change', function() {
      jumlahInput.value = 1;
      validateStock();
    });

    jumlahInput.addEventListener('input', validateStock);

    // =======================================================
    // LOGIKA PEMBAYARAN (KEMBALIAN)
    // =======================================================

    const InputTotal = document.getElementById('InputTotal');
    const InputBayar = document.getElementById('InputBayar');
    const InputKembalian = document.getElementById('InputKembalian');
    const displayKembalian = document.getElementById('displayKembalian');
    const btnSimpan = document.getElementById('btnSimpan');

    const formatRupiah = n => new Intl.NumberFormat('id-ID', {
      style: 'currency',
      currency: 'IDR',
      minimumFractionDigits: 0
    }).format(n);

    const hitungKembalian = () => {
      const total = +InputTotal.value || 0;
      const bayar = +InputBayar.value || 0;
      const kembalian = bayar - total;

      InputKembalian.value = kembalian;
      displayKembalian.value = formatRupiah(kembalian);

      // Aktifkan tombol simpan hanya jika uang bayar mencukupi
      if (bayar >= total && total > 0) {
        btnSimpan.disabled = false;
      } else {
        btnSimpan.disabled = true;
      }

      if (bayar === 0 || !bayar) {
        displayKembalian.value = formatRupiah(0);
      }
    };

    InputBayar.addEventListener('input', hitungKembalian);

    document.addEventListener('DOMContentLoaded', function() {
      hitungKembalian();
      validateStock();
      // Disable input jumlah di awal
      if (barangSelect.value === 'Pilih barang...' || barangSelect.selectedIndex === 0) {
        jumlahInput.disabled = true;
        tambahButton.disabled = true;
      }
    });
  </script>

</body>

</html>