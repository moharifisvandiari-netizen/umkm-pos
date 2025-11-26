<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetodePembayaran extends Model
{
    protected $fillable = ['nama_metode'];

    public function transaksiPenjualans()
    {
        return $this->hasMany(TransaksiPenjualan::class);
    }
}
