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
    Schema::create('pengiriman', function (Blueprint $table) {
        $table->id('Id_pengiriman'); // PK

        // Relasi ke pelanggan
        $table->foreignId('Id_pelanggan')->constrained('pelanggan', 'Id_pelanggan');

        $table->date('Tanggal_kirim');

        // Relasi ke karyawan (siapa yang input)
        $table->foreignId('Id_karyawan')->constrained('karyawan', 'Id_karyawan');

        // Status pengiriman (ENUM)
        $table->enum('Status_pengiriman', ['Dikirim', 'Selesai']);

        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengiriman');
    }
};
