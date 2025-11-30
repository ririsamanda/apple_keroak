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
        $table->id('Id_produk'); // Primary Key
        $table->string('Nama_produk', 100);
        $table->string('Kategori', 100)->nullable(); // Ada di dokumen Word 
        $table->string('Satuan', 50); // pcs, unit, box
        $table->decimal('Harga', 10, 2); // Menggunakan decimal agar presisi uang aman
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
