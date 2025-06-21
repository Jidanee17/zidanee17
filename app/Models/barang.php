<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    protected $table = 'barang';
    protected $fillable = [
        'kode',
        'nama',
        'harga',
        'stok',
    ];
    public function detail_transaksi()
    {
        return $this->hasMany(detail_transaksi::class);
    }
}
