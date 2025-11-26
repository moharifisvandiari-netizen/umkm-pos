<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MetodePembayaran;

class MetodePembayaranSeeder extends Seeder
{
    public function run()
    {
        $methods = [
            ['nama_metode' => 'Tunai'],
            ['nama_metode' => 'Debit'],
            ['nama_metode' => 'Kredit'],
            ['nama_metode' => 'Transfer'],
        ];

        foreach ($methods as $m) {
            MetodePembayaran::create($m);
        }
    }
}
