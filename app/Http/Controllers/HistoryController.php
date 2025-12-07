<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    /**
     * Menampilkan daftar riwayat transaksi dan total penjualan kotor.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        // Menggunakan ->get() untuk mengambil semua data (tanpa pagination)
        $transaksis = Transaksi::orderBy('tanggal', 'desc')->get();
        
        // 1. MENGHITUNG TOTAL PENJUALAN KOTOR
        // Menjumlahkan kolom 'total' dari semua transaksi
        $total_penjualan = $transaksis->sum('total'); 

        // 2. Menghitung total jumlah transaksi
        $total_transaksi_count = $transaksis->count();

        // Variabel $total_keuntungan DIHILANGKAN
        
        return view('history', [
            'transaksis' => $transaksis,
            'total_transaksi_count' => $total_transaksi_count,
            'total_penjualan' => $total_penjualan // Variabel yang akan digunakan di UI
        ]);
    }
}