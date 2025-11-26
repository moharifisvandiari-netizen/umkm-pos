<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'username','password','role'
    ];

    protected $hidden = [
        'password',
    ];

    public function penjualans()
    {
        return $this->hasMany(TransaksiPenjualan::class);
    }
}
