<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPembelian extends Model
{
    protected $fillable = [
        'transaksi_pembelian_id',
        'produk_id',
        'jumlah',
        'harga_modal'
    ];

    public function transaksiPembelian()
    {
        return $this->belongsTo(TransaksiPembelian::class);
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
