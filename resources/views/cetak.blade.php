<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Struk Transaksi - DakraMart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        @media print {
            .no-print {
                display: none;
            }

            body {
                font-size: 12px;
            }

            .card {
                border: none;
                box-shadow: none;
            }
        }

        .struk {
            width: 80mm;
            margin: auto;
        }

        hr.dashed {
            border-top: 1px dashed #000;
        }
    </style>
</head>

<body onload="window.print()">

    <div class="container struk pt-4">
        <div class="text-center">
            <h5 class="fw-bold">DakraMart</h5>
            <p class="mb-0">Jl. Contoh No. 1, Karanganyar</p>
            <p class="mb-2">Tanggal: {{ $transaksi->tanggal->format('Y-m-d H:i') }} | No:
                {{ $transaksi->kode_transaksi }}</p>
        </div>

        <hr class="dashed">

        <table class="table table-borderless table-sm mb-1">
            <thead>
                <tr>
                    <th>Barang</th>
                    <th class="text-end">Harga</th>
                    <th class="text-center">Qty</th>
                    <th class="text-end">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksi->detail_transaksi as $item)
                    <tr>
                        <td>{{ $item->barang->nama }}</td>
                        <td class="text-end">Rp {{ number_format($item->barang->harga) }}</td>
                        <td class="text-center">{{ $item->jumlah }}</td>
                        <td class="text-end">Rp {{ number_format($item->subtotal) }}</td>
                    </tr>
                @endforeach
            </tbody>

        </table>

        <hr class="dashed">

        <table class="table table-sm table-borderless">
            <tr>
                <td>Total</td>
                <td class="text-end">Rp {{ number_format($transaksi->total) }}</td>
            </tr>
            <tr>
                <td>Dibayar</td>
                <td class="text-end">Rp {{ number_format($transaksi->bayar) }}</td>
            </tr>
            <tr>
                <td>Kembalian</td>
                <td class="text-end">Rp {{ number_format($transaksi->kembalian) }}</td>
            </tr>
        </table>

        <hr class="dashed">

        <p class="text-center">~ Terima Kasih ~</p>

        <div class="text-center mt-3 no-print">
            <a href="{{ route('kasir.index') }}" class="btn btn-primary btn-sm">Kembali</a>
        </div>
    </div>
    <script src="{{ asset('assets/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
