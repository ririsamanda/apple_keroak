<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produksi extends Model
{
    use HasFactory;

    // 1. Definisikan nama tabel yang benar
    protected $table = 'produksi';

    // 2. Definisikan Primary Key
    protected $primaryKey = 'Id_produksi';

    // 3. Kolom yang boleh diisi
    protected $fillable = [
        'Id_produk',
        'Jumlah_selesai',
        'Tanggal_produksi',
        'Id_karyawan',
        'keterangan',
    ];

    // RELASI (Yang tadi sudah kita tambahkan untuk Laporan)
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'Id_produk', 'Id_produk');
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'Id_karyawan', 'Id_karyawan');
    }
}