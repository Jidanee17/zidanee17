<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon; // Import Carbon untuk menangani tanggal dan format kode transaksi
use App\Models\DetailTransaksi;

class Transaksi extends Model
{
    // Nama tabel di database (asumsi nama tabel adalah 'transaksi')
    protected $table = 'transaksi';

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'kode_transaksi', // WAJIB ada di sini agar dapat diisi saat 'creating'
        'total',
        'bayar',
        'kembalian',
        'tanggal',
    ];

    // Casting untuk konversi tipe data otomatis
    protected $casts = [
        'tanggal' => 'datetime', 
    ];

    /**
     * Relasi ke Detail Transaksi (satu Transaksi memiliki banyak DetailTransaksi)
     * Pastikan nama Model DetailTransaksi sesuai dengan nama file Anda.
     */
    public function detail_transaksi()
    {
        return $this->hasMany(detail_transaksi::class); 
    }
    
    /**
     * Accessor untuk Keuntungan/Laba Kotor. 
     * Saat ini dikembalikan 0 karena kolom di tabel riwayat telah dihapus.
     * Dapat dihidupkan kembali jika Anda memiliki data harga beli di DetailTransaksi.
     */
    public function getKeuntunganAttribute()
    {
        // Untuk saat ini, mengembalikan 0 atau nilai default jika laba kotor tidak dihitung
        return 0; 
    }


    /**
     * Metode boot() digunakan untuk mendefinisikan event model, seperti
     * mengisi kolom secara otomatis sebelum data disimpan.
     */
    protected static function boot()
    {
        parent::boot();

        // Event 'creating': dijalankan tepat sebelum data Transaksi baru disimpan ke database
        static::creating(function ($transaksi) {
            
            // 1. Definisikan prefix dan format tanggal hari ini (misal: TRX-251205)
            $prefix = 'TRX-' . Carbon::now()->format('ymd');

            // 2. Cari kode transaksi terakhir yang dibuat hari ini
            $lastTransaksi = static::where('kode_transaksi', 'like', $prefix . '%')
                                   ->latest('id') // Urutkan berdasarkan ID terbaru
                                   ->first();

            $number = 1;
            if ($lastTransaksi) {
                // Ambil 4 digit terakhir (nomor urut)
                // Contoh: dari TRX-251205-0005, diambil 0005.
                $lastNumber = (int) substr($lastTransaksi->kode_transaksi, -4);
                $number = $lastNumber + 1;
            }

            // 3. Gabungkan prefix dan nomor urut (padding 4 digit)
            // Hasil akhir: TRX-251205-0001
            $transaksi->kode_transaksi = $prefix . '-' . str_pad($number, 4, '0', STR_PAD_LEFT);
        });
    }
}