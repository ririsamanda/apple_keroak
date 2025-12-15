<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Notifications\Notifiable;

class Karyawan extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'karyawan';

    protected $primaryKey = 'Id_karyawan';

    protected $fillable = [
        'Nama_karyawan',
        'Username',
        'Password',
        'Id_hakakses',
        'Jabatan',
    ];

    protected $hidden = [
        'Password',
    ];

    public function getAuthPassword()
    {
        return $this->Password;
    }

    public function hakAkses()
    {
        return $this->belongsTo(HakAkses::class, 'Id_hakakses', 'Id_hakakses');
    }
}