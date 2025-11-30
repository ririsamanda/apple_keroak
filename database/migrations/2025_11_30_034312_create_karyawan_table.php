<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
    Schema::create('karyawan', function (Blueprint $table) {
        $table->id('Id_karyawan'); // Primary Key
        $table->string('Nama_karyawan', 100);
        $table->string('Username', 50)->unique(); // Unique agar tidak ada username kembar
        $table->string('Password', 255);

        // Foreign Key ke tabel hak_akses
        // Pastikan nama tabel referensi ('hak_akses') dan kolomnya ('Id_hakakses') benar
        $table->foreignId('Id_hakakses')->constrained('hak_akses', 'Id_hakakses');

        $table->string('Jabatan', 100);
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawan');
    }
};
