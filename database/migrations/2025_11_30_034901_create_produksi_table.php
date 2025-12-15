<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
    Schema::create('produksi', function (Blueprint $table) {
        $table->id('Id_produksi');

        $table->foreignId('Id_produk')->constrained('produk', 'Id_produk');

        $table->integer('Jumlah_selesai');
        $table->date('Tanggal_produksi');

        $table->foreignId('Id_karyawan')->constrained('karyawan', 'Id_karyawan');

        $table->text('keterangan')->nullable(); 
        $table->timestamps();
    });
    }

    public function down(): void
    {
        Schema::dropIfExists('produksi');
    }
};
