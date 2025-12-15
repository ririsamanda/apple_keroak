<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
    Schema::create('produk', function (Blueprint $table) {
        $table->id('Id_produk');
        $table->string('Nama_produk', 100);
        $table->string('Kategori', 100)->nullable();
        $table->string('Satuan', 50); 
        $table->decimal('Harga', 10, 2); 
        $table->integer('Stok')->default(0);
        $table->timestamps();
    });
    }

    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
