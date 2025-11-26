<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPenjualan extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','metode_pembayaran_id','total'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function metode_pembayaran()
    {
        return $this->belongsTo(MetodePembayaran::class);
    }

    public function details()
    {
        return $this->hasMany(DetailPenjualan::class);
    }
}
