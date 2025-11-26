<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    public function run()
    {
        $suppliers = [
            ['nama_supplier'=>'Supplier A','kontak'=>'081234567890','alamat'=>'Jl. Mawar No.1'],
            ['nama_supplier'=>'Supplier B','kontak'=>'081987654321','alamat'=>'Jl. Melati No.2'],
        ];

        foreach($suppliers as $s){
            Supplier::create($s);
        }
    }
}
