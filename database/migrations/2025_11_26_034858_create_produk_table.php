<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang')->unique();
            $table->string('nama_produk');
            $table->foreignId('kategori_id')->constrained('kategori')->cascadeOnDelete();
            $table->foreignId('satuan_id')->constrained('satuan')->cascadeOnDelete();
            $table->decimal('harga_modal', 15, 2);
            $table->decimal('harga_jual', 15, 2);
            $table->integer('stok')->default(0);
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
