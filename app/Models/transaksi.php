<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    protected $table = 'transaksi';
    protected $fillable = [
        'total',
        'bayar',
        'kembalian',
        'tanggal',
    ];
    public function detail_transaksi(){
        return $this->hasMany(detail_transaksi::class);
    }
}
