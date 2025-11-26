<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
