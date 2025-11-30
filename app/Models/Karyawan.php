<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Penting untuk Login
use Illuminate\Notifications\Notifiable;

class Karyawan extends Authenticatable
{
    use HasFactory, Notifiable;

    // 1. Beritahu Laravel nama tabel kita (karena bukan 'karyawans')
    protected $table = 'karyawan';

    // 2. Beritahu Primary Key kita (karena bukan 'id')
    protected $primaryKey = 'Id_karyawan';

    // 3. Kolom mana saja yang boleh diisi manual
    protected $fillable = [
        'Nama_karyawan',
        'Username',
        'Password',
        'Id_hakakses',
        'Jabatan',
    ];

    // 4. Sembunyikan password agar tidak ikut tertarik saat query API/JSON
    protected $hidden = [
        'Password',
    ];

    // 5. Override: Beritahu Laravel kolom password kita bernama 'Password' (Huruf besar)
    public function getAuthPassword()
    {
        return $this->Password;
    }

    // RELASI
    // Karyawan punya 1 Hak Akses
    public function hakAkses()
    {
        return $this->belongsTo(HakAkses::class, 'Id_hakakses', 'Id_hakakses');
    }
}