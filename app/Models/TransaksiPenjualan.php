<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiPenjualan extends Model
{
    protected $fillable = [
        'metode_pembayaran_id',
        'total_harga'
    ];

    public function metodePembayaran()
    {
        return $this->belongsTo(MetodePembayaran::class);
    }

    public function detailPenjualans()
    {
        return $this->hasMany(DetailPenjualan::class);
    }
}