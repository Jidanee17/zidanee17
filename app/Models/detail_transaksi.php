<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Pastikan Anda juga memiliki Model Transaksi dan Barang yang didefinisikan dengan benar
// use App\Models\Transaksi; // Tidak perlu jika sudah di namespace yang sama
// use App\Models\Barang;   // Tidak perlu jika sudah di namespace yang sama

class detail_transaksi extends Model // Nama kelas harus konsisten
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'detail_transaksi';

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'transaksi_id', // Kunci asing ke tabel transaksi
        'barang_id',    // Kunci asing ke tabel barang
        'jumlah',       // Jumlah barang yang dibeli
        'harga',        // Harga jual saat itu (harga per unit)
        'subtotal',     // Subtotal = harga * jumlah
        'harga_beli',   // Harga modal untuk perhitungan laba kotor
    ];

    /**
     * Relasi ke Transaksi
     */
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }

    /**
     * Relasi ke Barang
     */
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
    
    /**
     * Accessor untuk menghitung laba kotor per item.
     * Laba Kotor = Subtotal - (Harga Beli * Jumlah)
     */
    public function getLabaKotorAttribute()
    {
        $hargaBeli = $this->attributes['harga_beli'] ?? 0;
        return $this->subtotal - ($hargaBeli * $this->jumlah);
    }
}