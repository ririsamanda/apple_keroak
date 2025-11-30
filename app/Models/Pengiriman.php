<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    use HasFactory;
    protected $table = 'pengiriman';      // Nama tabel
    protected $primaryKey = 'Id_pengiriman'; // PK
    protected $fillable = ['Id_pelanggan', 'Tanggal_kirim', 'Id_karyawan', 'Status_pengiriman'];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'Id_pelanggan', 'Id_pelanggan');
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'Id_karyawan', 'Id_karyawan');
    }
}