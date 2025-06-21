<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kelola Barang - DakraMart</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="{{asset('assets/bootstrap.min.css')}}" rel="stylesheet">
</head>
<body>
 <!-- Navbar -->
 <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
      <span class="navbar-brand">DakraMart</span>
      <div class="ms-auto d-flex align-items-center text-white">
        <span class="me-3">Kasir: <strong>Nama Kasir</strong></span>
        <a href="{{route('barang.index')}}" class="btn btn-outline-light btn-sm m-2">Back</a>
    </div>
  </nav>

  <!-- Konten -->
  <div class="container py-4">
    <h4 class="mb-4">Kelola Data Barang</h4>

    <!-- Form Tambah/Edit Barang -->
    <div class="card mb-4">
      <div class="card-header">Form Barang</div>
      <div class="card-body">
        <form id="formBarang" action="{{route('barang.update',$barang->id)}}" method="POST">
            @csrf
            @method('put')
          <div class="row g-3">
            <div class="col-md-3">
              <label for="kode_barang" class="form-label">Kode Barang</label>
              <input type="text" class="form-control" id="kode_barang" name="kode" value="{{$barang->kode}}" required>
            </div>
            <div class="col-md-3">
              <label for="nama_barang" class="form-label">Nama Barang</label>
              <input type="text" class="form-control" id="nama_barang" name="nama" value="{{$barang->nama}}" required>
            </div>
            <div class="col-md-3">
              <label for="harga" class="form-label">Harga</label>
              <input type="number" class="form-control" id="harga" name="harga" value="{{$barang->harga}}" required>
            </div>
            <div class="col-md-3">
              <label for="stok" class="form-label">Stok</label>
              <input type="number" class="form-control" id="stok" name="stok" value="{{$barang->stok}}"  required>
            </div>
          </div>
          <div class="mt-3">
            <button type="submit" class="btn btn-success">Simpan</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="{{asset('assets/bootstrap.bundle.min.js')}}"></script>
</body>
</html>
