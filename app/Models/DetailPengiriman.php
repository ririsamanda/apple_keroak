<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPengiriman extends Model
{
    use HasFactory;
    protected $table = 'detail_pengiriman'; // Nama tabel
    protected $primaryKey = 'Id_detail';    // PK
    protected $fillable = ['Id_pengiriman', 'Id_produk', 'Jumlah_kirim', 'keterangan'];
}