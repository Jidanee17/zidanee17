<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Kelola Barang</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="{{asset('assets/bootstrap.min.css')}}" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <style>
    /* Variabel Warna Coklat Pastel Kustom */
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

    /* Update Navbar Styling */
    .bg-primary-custom {
      background-color: var(--pastel-brown) !important;
      box-shadow: 0 2px 10px rgba(139, 115, 110, 0.2);
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
      /* Padding header dikurangi sedikit */
      border-top-left-radius: 12px;
      border-top-right-radius: 12px;
    }

    /* Form Inputs */
    .form-label {
      font-weight: 600;
      color: #555;
      font-size: 0.85rem;
      /* Font label sedikit diperkecil */
      margin-bottom: 0.3rem;
    }

    .form-control,
    .form-select {
      border: 1px solid #ddd;
      border-radius: 6px;
    }

    /* Style khusus untuk input small (sm) */
    .form-control-sm {
      padding: 0.4rem 0.8rem;
      font-size: 0.9rem;
    }

    .form-control:focus {
      border-color: var(--pastel-brown);
      box-shadow: 0 0 0 0.2rem rgba(183, 161, 157, 0.15);
    }

    /* Input Groups (Rp & %) */
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

    .btn-primary-custom {
      background-color: var(--pastel-brown);
      color: white;
      border: none;
    }

    .btn-primary-custom:hover {
      background-color: var(--pastel-dark);
      color: white;
    }

    /* --- PERBAIKAN TABEL --- */
    /* Wrapper khusus untuk menangani border radius yang putus */
    .table-wrapper {
      border-radius: 12px;
      overflow: hidden;
      border: 1px solid var(--pastel-dark);
      /* Border dipindah ke wrapper */
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .table-custom {
      margin-bottom: 0;
      /* Hilangkan margin bawah default bootstrap */
      border-collapse: collapse;
    }

    /* Header Tabel */
    .table-custom thead th {
      background-color: var(--pastel-brown);
      color: white;
      border: none;
      /* Hilangkan border bawaan th */
      padding: 12px;
      vertical-align: middle;
    }

    /* Baris Tabel */
    .table-custom tbody td {
      border-bottom: 1px solid #e0e0e0;
      /* Border halus antar baris */
      border-right: none;
      border-left: none;
      padding: 10px 12px;
      /* Padding cell sedikit diperkecil */
      font-size: 0.95rem;
    }

    /* Hapus border baris terakhir agar tidak double dengan wrapper */
    .table-custom tbody tr:last-child td {
      border-bottom: none;
    }

    /* Aksi Cell */
    .table-action-cell {
      display: flex;
      gap: 5px;
      justify-content: center;
      align-items: center;
    }

    /* Navbar Styling */
    .bg-primary-custom {
      background-color: var(--pastel-brown) !important;
      box-shadow: 0 2px 10px rgba(139, 115, 110, 0.2);
    }
  </style>
</head>

<body>

  <!-- Navbar -->
  <!-- Navbar Updated -->
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

    <!-- Header Page & Search -->
    <!-- Diubah menjadi row untuk menampung judul di kiri dan search di kanan -->
    <div class="row align-items-center mb-3">
      <div class="col-md-6">
        <h4 class="mb-0" style="color: var(--pastel-dark); font-weight: bold;"><i class="fas fa-boxes me-2"></i> Kelola Data Barang</h4>
      </div>
      <div class="col-md-6 text-end">
        <!-- Form Pencarian -->
        <form action="{{ url()->current() }}" method="GET" class="d-flex justify-content-md-end mt-2 mt-md-0">
          <div class="input-group" style="max-width: 300px;">
            <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari Kode atau Nama..." value="{{ request('search') }}">
            <button class="btn btn-primary-custom btn-sm" type="submit"><i class="fas fa-search"></i></button>
            @if(request('search'))
            <a href="{{ url()->current() }}" class="btn btn-secondary btn-sm" title="Reset"><i class="fas fa-times"></i></a>
            @endif
          </div>
        </form>
      </div>
    </div>

    <!-- Alert Sukses -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show py-2" role="alert">
      <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close" style="padding: 1rem;"></button>
    </div>
    @endif

    <!-- --- FORM LEBIH KOMPAK (Compact) --- -->
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="card mb-4"> <!-- mb-5 dikurangi jadi mb-4 -->
          <div class="card-header py-2">
            <i class="fas fa-plus-circle me-2"></i> Form Input Barang Baru
          </div>
          <div class="card-body p-3"> <!-- Padding dikurangi jadi p-3 -->
            <form id="formBarang" action="{{route('barang.store')}}" method="POST">
              @csrf

              <!-- Menggunakan layout 2 baris agar lebih pendek secara vertikal -->
              <div class="row g-3 align-items-end">

                <!-- Baris 1: Kode (25%), Nama (45%), Harga (30%) -->
                <div class="col-md-3">
                  <label for="kode_barang" class="form-label">Kode Barang</label>
                  <input type="text"
                    class="form-control form-control-sm @error('kode') is-invalid @enderror"
                    id="kode_barang"
                    name="kode"
                    placeholder="BRG-001"
                    value="{{ old('kode') }}"
                    required>
                </div>

                <div class="col-md-5">
                  <label for="nama_barang" class="form-label">Nama Barang</label>
                  <input type="text"
                    class="form-control form-control-sm @error('nama') is-invalid @enderror"
                    id="nama_barang"
                    name="nama"
                    placeholder="Masukkan nama produk..."
                    value="{{ old('nama') }}"
                    required>
                </div>

                <div class="col-md-4">
                  <label for="harga" class="form-label">Harga Jual</label>
                  <div class="input-group input-group-sm">
                    <span class="input-group-text">Rp</span>
                    <input type="number"
                      class="form-control form-control-sm"
                      id="harga"
                      name="harga"
                      value="{{ old('harga') }}"
                      required>
                  </div>
                </div>

                <!-- Baris 2: Stok (20%), Diskon (20%), Tombol (60%) -->
                <div class="col-md-3">
                  <label for="stok" class="form-label">Stok</label>
                  <input type="number"
                    class="form-control form-control-sm"
                    id="stok"
                    name="stok"
                    placeholder="0"
                    value="{{ old('stok') }}"
                    required>
                </div>

                <div class="col-md-3">
                  <label for="diskon" class="form-label">Diskon</label>
                  <div class="input-group input-group-sm">
                    <input type="number"
                      class="form-control form-control-sm @error('diskon') is-invalid @enderror"
                      id="diskon"
                      name="diskon"
                      value="{{ old('diskon', 0) }}"
                      min="0"
                      max="100">
                    <span class="input-group-text">%</span>
                  </div>
                </div>

                <div class="col-md-6 d-flex justify-content-end gap-2">
                  <button type="reset" class="btn btn-secondary btn-sm px-3"><i class="fas fa-redo me-1"></i> Reset</button>
                  <button type="submit" class="btn btn-success btn-sm px-4"><i class="fas fa-save me-1"></i> Simpan Data</button>
                </div>

              </div>

              <!-- Menampilkan Error Message dengan ringkas jika ada -->
              @if($errors->any())
              <div class="mt-2">
                @foreach($errors->all() as $error)
                <span class="text-danger small me-2"><i class="fas fa-exclamation-circle"></i> {{ $error }}</span>
                @endforeach
              </div>
              @endif

            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Akhir Perbaikan Form -->

    <!-- Tabel Data Barang -->
    <div class="card shadow-sm border-0 bg-transparent">
      <div class="card-body p-0">
        <div class="table-wrapper">
          <table class="table table-striped align-middle table-custom">
            <thead>
              <tr>
                <th class="text-center" width="5%">No</th>
                <th width="15%">Kode</th>
                <th width="30%">Nama Barang</th>
                <th class="text-end" width="15%">Harga</th>
                <th class="text-center" width="10%">Stok</th>
                <th class="text-center" width="10%">Diskon</th>
                <th class="text-center" width="15%">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($barang as $num => $row)
              <tr>
                <td class="text-center">{{$num+1}}</td>
                <td class="fw-bold text-muted">{{$row->kode}}</td>
                <td>{{$row->nama}}</td>
                <td class="text-end">Rp {{number_format($row->harga)}}</td>

                <td class="text-center">
                  @if($row->stok <= 5)
                    <span class="badge bg-danger">{{$row->stok}}</span>
                    @else
                    <span class="badge bg-success">{{$row->stok}}</span>
                    @endif
                </td>

                <td class="text-center">
                  @if($row->diskon > 0)
                  <span class="badge bg-warning text-dark">{{ $row->diskon }}%</span>
                  @else
                  <span class="text-muted">-</span>
                  @endif
                </td>

                <td class="text-center">
                  <div class="table-action-cell">
                    <a href="{{route('barang.edit',$row->id)}}" class="btn btn-sm btn-warning" title="Edit">
                      <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{route('barang.destroy',$row->id)}}" method="POST" class="d-inline">
                      @csrf
                      @method('delete')
                      <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus barang ini?')" title="Hapus">
                        <i class="fas fa-trash-alt"></i>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="7" class="text-center py-4 text-muted">
                  <i class="fas fa-box-open fa-2x mb-2"></i><br>
                  Data barang tidak ditemukan.
                </td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="{{asset('assets/bootstrap.bundle.min.js')}}"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Auto-hide alert
      const successAlert = document.querySelector('.alert-success');
      if (successAlert) {
        setTimeout(() => {
          successAlert.classList.remove('show');
          successAlert.classList.add('fade');
          setTimeout(() => successAlert.remove(), 500);
        }, 1500);
      }
    });
  </script>
</body>

</html>