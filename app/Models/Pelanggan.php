<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    // 1. Beritahu nama tabel yang benar
    protected $table = 'pelanggan';

    // 2. Beritahu Primary Key
    protected $primaryKey = 'Id_pelanggan';

    // 3. Kolom yang boleh diisi
    protected $fillable = [
        'Nama_pelanggan',
        'Alamat',
        'No_telp',
    ];
}