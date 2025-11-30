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
    Schema::create('produksi', function (Blueprint $table) {
        $table->id('Id_produksi'); // PK

        // Relasi ke tabel produk
        $table->foreignId('Id_produk')->constrained('produk', 'Id_produk');

        $table->integer('Jumlah_selesai');
        $table->date('Tanggal_produksi');

        // Relasi ke tabel karyawan (siapa yang input/mengerjakan)
        $table->foreignId('Id_karyawan')->constrained('karyawan', 'Id_karyawan');

        $table->text('keterangan')->nullable(); // Opsional
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produksi');
    }
};
