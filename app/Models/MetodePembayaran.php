<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodePembayaran extends Model
{
    use HasFactory;

    protected $table = 'metode_pembayaran'; // sesuai nama tabel migration
    protected $fillable = ['nama_metode'];

    public function penjualans()
    {
        return $this->hasMany(TransaksiPenjualan::class);
    }
}
