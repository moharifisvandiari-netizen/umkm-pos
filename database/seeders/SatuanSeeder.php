<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Satuan;

class SatuanSeeder extends Seeder
{
    public function run()
    {
        $satuan = ['pcs','bungkus','botol','liter','dus'];
        foreach($satuan as $s){
            Satuan::create(['nama_satuan'=>$s]);
        }
    }
}
