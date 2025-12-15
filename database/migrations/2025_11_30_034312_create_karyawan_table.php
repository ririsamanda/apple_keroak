<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
    Schema::create('karyawan', function (Blueprint $table) {
        $table->id('Id_karyawan'); 
        $table->string('Nama_karyawan', 100);
        $table->string('Username', 50)->unique();
        $table->string('Password', 255);

        $table->foreignId('Id_hakakses')->constrained('hak_akses', 'Id_hakakses');

        $table->string('Jabatan', 100);
        $table->timestamps();
    });
    }

    public function down(): void
    {
        Schema::dropIfExists('karyawan');
    }
};
