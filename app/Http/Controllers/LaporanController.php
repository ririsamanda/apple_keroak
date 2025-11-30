<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produksi;
use App\Models\Pengiriman;

class LaporanController extends Controller
{
    public function index()
    {
        // 1. Ambil Data Produksi (disertai info Produk & Karyawan)
        $riwayatProduksi = Produksi::with(['produk', 'karyawan'])
                                   ->latest('Tanggal_produksi')
                                   ->get();

        // 2. Ambil Data Pengiriman (disertai info Pelanggan & Karyawan)
        $riwayatPengiriman = Pengiriman::with(['pelanggan', 'karyawan'])
                                       ->latest('Tanggal_kirim')
                                       ->get();

        return view('admin.laporan.index', compact('riwayatProduksi', 'riwayatPengiriman'));
    }

    // 1. Fungsi Hapus Data Produksi
    public function destroyProduksi($id)
    {
        $data = Produksi::findOrFail($id);
        $data->delete();

        return back()->with('success', 'Data produksi berhasil dihapus.');
    }

    // 2. Fungsi Hapus Data Pengiriman
    public function destroyPengiriman($id)
    {
        $data = Pengiriman::findOrFail($id);
        
        // Karena di database kita sudah set 'onDelete cascade', 
        // maka detail_pengiriman akan ikut terhapus otomatis.
        $data->delete();

        return back()->with('success', 'Data pengiriman berhasil dihapus.');
    }
}