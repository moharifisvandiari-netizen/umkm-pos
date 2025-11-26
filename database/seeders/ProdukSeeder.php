<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produk;

class ProdukSeeder extends Seeder
{
    public function run()
    {
        Produk::create([
            'kode_barang'=>'BRG001',
            'nama_produk'=>'Teh Botol',
            'kategori_id'=>1, // Minuman
            'satuan_id'=>3,   // botol
            'harga_modal'=>2000,
            'harga_jual'=>3000,
            'stok'=>50,
            'status'=>'aktif'
        ]);

        Produk::create([
            'kode_barang'=>'BRG002',
            'nama_produk'=>'Indomie Goreng',
            'kategori_id'=>2, // Sembako
            'satuan_id'=>1,   // pcs
            'harga_modal'=>2500,
            'harga_jual'=>4000,
            'stok'=>100,
            'status'=>'aktif'
        ]);
    }
}
