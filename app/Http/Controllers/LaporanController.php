<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produksi;
use App\Models\Pengiriman;

class LaporanController extends Controller
{
    public function index()
    {
        $riwayatProduksi = Produksi::with(['produk', 'karyawan'])
                                   ->latest('Tanggal_produksi')
                                   ->get();

        $riwayatPengiriman = Pengiriman::with(['pelanggan', 'karyawan'])
                                       ->latest('Tanggal_kirim')
                                       ->get();

        return view('admin.laporan.index', compact('riwayatProduksi', 'riwayatPengiriman'));
    }

    public function destroyProduksi($id)
    {
        $data = Produksi::findOrFail($id);
        $data->delete();

        return back()->with('success', 'Data produksi berhasil dihapus.');
    }

    public function destroyPengiriman($id)
    {
        $data = Pengiriman::findOrFail($id);
        $data->delete();

        return back()->with('success', 'Data pengiriman berhasil dihapus.');
    }
}