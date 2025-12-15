<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
    Schema::create('pengiriman', function (Blueprint $table) {
        $table->id('Id_pengiriman');

        $table->foreignId('Id_pelanggan')->constrained('pelanggan', 'Id_pelanggan');

        $table->date('Tanggal_kirim');

        $table->foreignId('Id_karyawan')->constrained('karyawan', 'Id_karyawan');

        $table->enum('Status_pengiriman', ['Dikirim', 'Selesai']);

        $table->timestamps();
    });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengiriman');
    }
};
