<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    protected $table = 'satuan'; // sesuai nama tabel di migration
    protected $fillable = ['nama_satuan'];
}
