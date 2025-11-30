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
    Schema::create('detail_pengiriman', function (Blueprint $table) {
        $table->id('Id_detail'); // PK

        // Relasi ke Pengiriman (Jika pengiriman dihapus, detail ikut terhapus/cascade)
        $table->foreignId('Id_pengiriman')
              ->constrained('pengiriman', 'Id_pengiriman')
              ->onDelete('cascade');

        // Relasi ke Produk
        $table->foreignId('Id_produk')->constrained('produk', 'Id_produk');

        $table->integer('Jumlah_kirim');
        $table->text('keterangan')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pengiriman');
    }
};
