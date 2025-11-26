<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = [
        'kode_barang',
        'nama_produk',
        'kategori_id',
        'satuan_id',
        'harga_modal',
        'harga_jual',
        'stok',
        'status'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function satuan()
    {
        return $this->belongsTo(Satuan::class);
    }

    public function detailPembelians()
    {
        return $this->hasMany(DetailPembelian::class);
    }

    public function detailPenjualans()
    {
        return $this->hasMany(DetailPenjualan::class);
    }
}