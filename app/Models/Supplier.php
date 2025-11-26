<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    
    protected $fillable = ['nama_supplier', 'kontak', 'alamat', 'catatan'];

    public function pembelians()
    {
        return $this->hasMany(TransaksiPembelian::class);
    }
}
