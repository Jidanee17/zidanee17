<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Detail Transaksi</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="{{asset('assets/bootstrap.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  
  <style>
    /* Gunakan style yang konsisten dengan halaman lain */
    :root { --pastel-brown: #B7A19D; --pastel-light: #EBE5E4; --pastel-success: #93C47D; }
    body { background-color: var(--pastel-light) !important; }
    .bg-primary-custom { background-color: var(--pastel-brown) !important; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); }
    .table-light-custom { background-color: var(--pastel-brown); color: white; }
    .btn-primary-custom { background-color: var(--pastel-brown); border-color: var(--pastel-brown); }
    .btn-primary-custom:hover { background-color: #8C7570; border-color: #8C7570; }
  </style>
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary-custom">
        <div class="container-fluid">
            <span class="navbar-brand">IF7MART</span> 
            <div class="ms-auto">
                <a href="{{route('history.index')}}" class="btn btn-outline-light btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Kembali ke Riwayat
                </a>
            </div>
        </div>
    </nav>

    <div class="container py-4">
        <h4 class="mb-4"><i class="fas fa-info-circle me-2"></i> Detail Transaksi</h4>

        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary-custom text-white">
                <i class="fas fa-receipt me-1"></i> Transaksi No. {{ $transaksi->kode_transaksi }}
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6"><strong>Tanggal:</strong> {{ $transaksi->tanggal->format('d M Y H:i:s') }}</div>
                    <div class="col-md-6"><strong>Kasir:</strong> {{ $transaksi->kasir_nama ?? 'Kasir Default' }}</div>
                </div>
                
                <h5 class="mt-4 mb-3">Item Transaksi:</h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-light-custom">
                            <tr>
                                <th>Barang</th>
                                <th class="text-center">Qty</th>
                                <th class="text-end">Harga Satuan</th>
                                <th class="text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaksi->detail_transaksi as $detail)
                            <tr>
                                <td>{{ $detail->barang->nama ?? 'Barang Dihapus' }}</td>
                                <td class="text-center">{{ $detail->jumlah }}</td>
                                <td class="text-end">Rp {{ number_format($detail->barang->harga ?? 0) }}</td>
                                <td class="text-end">Rp {{ number_format($detail->subtotal) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <hr class="mt-4">
                
                <div class="row">
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                        <table class="table table-borderless table-sm">
                            <tr>
                                <td><strong>Total Belanja:</strong></td>
                                <td class="text-end"><strong>Rp {{ number_format($transaksi->total) }}</strong></td>
                            </tr>
                            <tr>
                                <td>Dibayar:</td>
                                <td class="text-end">Rp {{ number_format($transaksi->bayar) }}</td>
                            </tr>
                            <tr class="fw-bold text-success">
                                <td>Kembalian:</td>
                                <td class="text-end">Rp {{ number_format($transaksi->kembalian) }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="{{ route('transaksi.print', $transaksi->id) }}" class="btn btn-primary-custom">
                        <i class="fas fa-print me-1"></i> Cetak Struk
                    </a>
                </div>
            </div>
        </div>
    </div>

  <script src="{{asset('assets/bootstrap.bundle.min.js')}}"></script>
</body>
</html>