<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produksi extends Model
{
    use HasFactory;

    protected $table = 'produksi';
    protected $primaryKey = 'Id_produksi';
    protected $fillable = [
        'Id_produk',
        'Jumlah_selesai',
        'Tanggal_produksi',
        'Id_karyawan',
        'keterangan',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'Id_produk', 'Id_produk');
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'Id_karyawan', 'Id_karyawan');
    }
}