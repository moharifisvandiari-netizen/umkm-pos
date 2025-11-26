<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run()
    {
        $kategori = ['Minuman','Sembako','Snack','Rumah Tangga','Obat'];
        foreach($kategori as $k){
            Kategori::create(['nama_kategori'=>$k]);
        }
    }
}
