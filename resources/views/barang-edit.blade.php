<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Edit Barang</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="{{asset('assets/bootstrap.min.css')}}" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <style>
    /* Menggunakan Style yang SAMA PERSIS dengan Halaman Index */
    :root {
      --pastel-brown: #B7A19D;
      --pastel-light: #EBE5E4;
      --pastel-dark: #8C7570;
      --pastel-success: #93C47D;
      --pastel-warning: #FFDDAA;
      --pastel-secondary: #C0C0C0;
    }

    body {
      background-color: var(--pastel-light) !important;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;

    }

    /* Navbar */
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
    }

    .btn-nav-custom:hover {
      background-color: var(--pastel-dark);
      border-color: var(--pastel-dark);
      color: white;
    }

    /* Card Styling */
    .card {
      border-radius: 12px;
      border: none;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    .card-header {
      background-color: white;
      border-bottom: 2px solid var(--pastel-light);
      font-weight: bold;
      color: var(--pastel-dark);
      padding: 0.8rem 1.5rem;
      border-top-left-radius: 12px;
      border-top-right-radius: 12px;
    }

    /* Form Inputs Compact */
    .form-label {
      font-weight: 600;
      color: #555;
      font-size: 0.85rem;
      margin-bottom: 0.3rem;
    }

    .form-control,
    .form-select {
      border: 1px solid #ddd;
      border-radius: 6px;
    }

    .form-control-sm {
      padding: 0.4rem 0.8rem;
      font-size: 0.9rem;
    }

    .form-control:focus {
      border-color: var(--pastel-brown);
      box-shadow: 0 0 0 0.2rem rgba(183, 161, 157, 0.15);
    }

    .input-group-text {
      background-color: var(--pastel-light);
      border: 1px solid #ddd;
      color: var(--pastel-dark);
      font-weight: bold;
      font-size: 0.9rem;
    }

    /* Tombol */
    .btn-success {
      background-color: var(--pastel-success);
      border-color: var(--pastel-success);
      font-weight: 500;
    }

    .btn-success:hover {
      background-color: #7AA865 !important;
      border-color: #7AA865 !important;
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
            <a href="{{route('history.index')}}" class="btn btn-nav-custom btn-sm mx-1">
              <i class="fas fa-history me-1"></i> Riwayat
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

  <div class="container py-4">

    <!-- Header Page -->
    <div class="row align-items-center mb-3">
      <div class="col-md-6">
        <h4 class="mb-0" style="color: var(--pastel-dark); font-weight: bold;"><i class="fas fa-edit me-2"></i> Edit Data Barang</h4>
      </div>
      <div class="col-md-6 text-end">
        <a href="{{ route('barang.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
      </div>
    </div>

    <!-- Alert Error Global -->
    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show py-2 mb-3" role="alert">
      <i class="fas fa-exclamation-triangle me-2"></i> Terdapat kesalahan pada inputan Anda.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Form Edit Kompak -->
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="card shadow-sm">
          <div class="card-header py-2">
            <i class="fas fa-pen me-2"></i> Form Perubahan Data
          </div>
          <div class="card-body p-3">
            <form id="formBarang" action="{{route('barang.update', $barang->id)}}" method="POST">
              @csrf
              @method('PUT')

              <div class="row g-3 align-items-end">

                <!-- Baris 1: Kode (Readonly), Nama, Harga -->
                <div class="col-md-3">
                  <label for="kode_barang" class="form-label">Kode Barang</label>
                  <input type="text"
                    class="form-control form-control-sm @error('kode') is-invalid @enderror"
                    id="kode_barang"
                    name="kode"
                    value="{{ old('kode', $barang->kode) }}"
                    required>
                  @error('kode')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-5">
                  <label for="nama_barang" class="form-label">Nama Barang</label>
                  <input type="text"
                    class="form-control form-control-sm @error('nama') is-invalid @enderror"
                    id="nama_barang"
                    name="nama"
                    value="{{ old('nama', $barang->nama) }}"
                    required>
                  @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-4">
                  <label for="harga" class="form-label">Harga Jual</label>
                  <div class="input-group input-group-sm">
                    <span class="input-group-text">Rp</span>
                    <input type="number"
                      class="form-control form-control-sm"
                      id="harga"
                      name="harga"
                      value="{{ old('harga', $barang->harga) }}"
                      required>
                  </div>
                </div>

                <!-- Baris 2: Stok, Diskon, Tombol -->
                <div class="col-md-3">
                  <label for="stok" class="form-label">Stok</label>
                  <input type="number"
                    class="form-control form-control-sm"
                    id="stok"
                    name="stok"
                    value="{{ old('stok', $barang->stok) }}"
                    required>
                </div>

                <div class="col-md-3">
                  <label for="diskon" class="form-label">Diskon</label>
                  <div class="input-group input-group-sm">
                    <input type="number"
                      class="form-control form-control-sm @error('diskon') is-invalid @enderror"
                      id="diskon"
                      name="diskon"
                      value="{{ old('diskon', $barang->diskon ?? 0) }}"
                      min="0"
                      max="100">
                    <span class="input-group-text">%</span>
                  </div>
                  @error('diskon')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6 d-flex justify-content-end gap-2">
                  <button type="reset" class="btn btn-secondary btn-sm px-3"><i class="fas fa-redo me-1"></i> Reset</button>
                  <button type="submit" class="btn btn-success btn-sm px-4"><i class="fas fa-save me-1"></i> Simpan Perubahan</button>
                </div>

              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Bootstrap JS -->
  <script src="{{asset('assets/bootstrap.bundle.min.js')}}"></script>
</body>

</html>