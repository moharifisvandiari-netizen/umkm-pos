<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiPembelian extends Model
{
    protected $fillable = [
        'supplier_id',
        'total_harga'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function detailPembelians()
    {
        return $this->hasMany(DetailPembelian::class);
    }
}
