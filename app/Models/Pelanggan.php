<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggan';
    protected $primaryKey = 'Id_pelanggan';
    protected $fillable = [
        'Nama_pelanggan',
        'Alamat',
        'No_telp',
    ];
}