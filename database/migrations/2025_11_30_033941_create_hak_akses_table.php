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
    Schema::create('hak_akses', function (Blueprint $table) {
        // Membuat Primary Key dengan nama 'Id_hakakses' sesuai dokumen
        $table->id('Id_hakakses'); 

        // Kolom Nama_hakakses, tipe VARCHAR(50)
        $table->string('Nama_hakakses', 50);

        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hak_akses');
    }
};
