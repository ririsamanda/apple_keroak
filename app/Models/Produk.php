<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    // 1. Definisikan nama tabel yang benar (override default Laravel)
    protected $table = 'produk';

    // 2. Definisikan Primary Key
    protected $primaryKey = 'Id_produk';

    // 3. Kolom yang boleh diisi (Mass Assignment)
    protected $fillable = [
        'Nama_produk',
        'Kategori',
        'Satuan',
        'Harga',
    ];
}