<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
    Schema::create('hak_akses', function (Blueprint $table) {
        $table->id('Id_hakakses'); 
        $table->string('Nama_hakakses', 50);
        $table->timestamps();
    });
    }

    public function down(): void
    {
        Schema::dropIfExists('hak_akses');
    }
};
