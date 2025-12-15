<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';
    protected $primaryKey = 'Id_produk';
    protected $fillable = [
        'Nama_produk',
        'Kategori',
        'Satuan',
        'Harga',
    ];
}