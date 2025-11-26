<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodePembayaran extends Model
{
    use HasFactory;

    protected $fillable = ['nama_metode'];

    public function penjualans()
    {
        return $this->hasMany(TransaksiPenjualan::class);
    }
}
