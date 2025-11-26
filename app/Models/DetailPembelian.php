<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPembelian extends Model
{
    use HasFactory;

    protected $fillable = ['transaksi_pembelian_id','produk_id','jumlah','harga_modal','subtotal'];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

    public function transaksi()
    {
        return $this->belongsTo(TransaksiPembelian::class,'transaksi_pembelian_id');
    }
}
