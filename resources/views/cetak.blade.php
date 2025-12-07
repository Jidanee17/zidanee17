<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Struk Transaksi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('assets/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        /* CSS KHUSUS CETAK STRUK */
        @media print {
            .no-print {
                display: none;
            }

            /* Gunakan ukuran font yang lebih kecil untuk efisiensi */
            body {
                font-size: 10px;
                font-family: 'Courier New', Courier, monospace;
                /* Font monospace agar lebih rapi seperti struk asli */
                margin: 0;
                padding: 0;
            }

            .container.struk {
                width: 58mm;
                /* Sesuaikan dengan lebar kertas thermal umumnya (58mm atau 80mm) */
                padding: 0;
                margin: 0;
            }

            .table {
                margin-bottom: 0 !important;
                width: 100%;
            }

            .table td,
            .table th {
                padding: 1px 0;
                border: none !important;
            }

            /* Teks Total harus menonjol */
            .total-row td {
                font-weight: bold;
                border-top: 1px dashed #000 !important;
                padding-top: 5px;
            }
        }

        /* Gaya tampilan di browser (Preview) */
        .struk {
            width: 80mm;
            margin: 20px auto;
            border: 1px solid #ccc;
            padding: 15px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        hr.dashed {
            border-top: 1px dashed #000;
            margin-top: 5px;
            margin-bottom: 5px;
            opacity: 1;
        }

        .header-info p {
            line-height: 1.2;
            margin-bottom: 2px;
        }

        .fw-bold {
            font-weight: 700;
        }

        .text-end {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .small-text {
            font-size: 0.9em;
            color: #555;
        }
    </style>
</head>

<body onload="window.print()">

    <div class="container struk">

        <div class="text-center header-info mb-3">
            <h5 class="fw-bold mb-1">IF7MART</h5>
            <p>Jl. Dipatiukur No. 112–114</p>
            <p>Kota Bandung</p>
            <p>Telp: 022 1234 5678</p>
        </div>

        <hr class="dashed">

        <div class="info-transaksi mb-2" style="font-size: 0.9rem;">
            <div class="d-flex justify-content-between">
                <span>No: {{ $transaksi->kode_transaksi ?? $transaksi->id }}</span>
            </div>
            <div class="d-flex justify-content-between">
                <span>Tgl: {{ $transaksi->tanggal->format('d/m/Y H:i') }}</span>
                <span>Kasir: Admin</span>
            </div>
        </div>

        <hr class="dashed">

        <table class="table table-borderless table-sm">
            <tbody>
                @foreach ($transaksi->detail_transaksi as $item)
                @php
                // Logika hitung diskon untuk tampilan
                $hargaNormalSatuan = $item->barang->harga;
                $totalTanpaDiskon = $hargaNormalSatuan * $item->jumlah;
                $totalBayarItem = $item->subtotal;

                // Hitung selisih untuk mengetahui nominal diskon
                $nominalDiskon = $totalTanpaDiskon - $totalBayarItem;
                @endphp

                <tr>
                    {{-- Baris 1: Nama Barang --}}
                    <td colspan="4" class="fw-bold p-0">{{ $item->barang->nama }}</td>
                </tr>

                <tr>
                    {{-- Baris 2: Rincian Qty x Harga Asli --}}
                    <td class="p-0 text-start" width="10%">{{ $item->jumlah }} x</td>
                    <td class="p-0 text-start">Rp {{ number_format($hargaNormalSatuan, 0, ',', '.') }}</td>

                    {{-- Jika tidak ada diskon, langsung tampilkan total --}}
                    @if($nominalDiskon <= 0)
                        <td class="p-0 text-end">Rp {{ number_format($totalBayarItem, 0, ',', '.') }}</td>
                        @else
                        {{-- Jika ada diskon, biarkan kosong dulu baris ini agar rapi, total ditaruh bawah --}}
                        <td class="p-0 text-end">Rp {{ number_format($totalTanpaDiskon, 0, ',', '.') }}</td>
                        @endif
                </tr>

                {{-- Baris Khusus Diskon (Hanya muncul jika ada diskon) --}}
                @if($nominalDiskon > 0)
                <tr>
                    <td colspan="2" class="p-0 text-end small-text fst-italic">Disc.</td>
                    <td class="p-0 text-end small-text text-danger">-(Rp {{ number_format($nominalDiskon, 0, ',', '.') }})</td>
                </tr>
                <tr>
                    <td colspan="2" class="p-0"></td>
                    <td class="p-0 text-end fw-bold">Rp {{ number_format($totalBayarItem, 0, ',', '.') }}</td>
                </tr>
                @endif

                {{-- Jarak antar item --}}
                <tr>
                    <td colspan="3" style="height: 5px;"></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <hr class="dashed">

        <table class="table table-sm table-borderless">
            <tr>
                <td>Total Belanja</td>
                <td class="text-end fw-bold">Rp {{ number_format($transaksi->total, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Tunai</td>
                <td class="text-end">Rp {{ number_format($transaksi->bayar, 0, ',', '.') }}</td>
            </tr>
            <tr class="total-row">
                <td>KEMBALIAN</td>
                <td class="text-end">Rp {{ number_format($transaksi->kembalian, 0, ',', '.') }}</td>
            </tr>
        </table>

        <hr class="dashed">

        <div class="text-center mt-3">
            <p class="mb-1 fw-bold">TERIMA KASIH</p>
            <p class="small-text mb-0">Barang yang sudah dibeli tidak dapat ditukar/dikembalikan.</p>
        </div>

        <div class="text-center mt-4 mb-4 no-print">
            <a href="{{ route('kasir.index') }}" class="btn btn-dark btn-sm w-100 mb-2">
                Kembali ke Menu Kasir
            </a>
            <button onclick="window.print()" class="btn btn-outline-secondary btn-sm w-100">
                Cetak Ulang
            </button>
        </div>
    </div>

    <script src="{{ asset('assets/bootstrap.bundle.min.js') }}"></script>
</body>

</html>