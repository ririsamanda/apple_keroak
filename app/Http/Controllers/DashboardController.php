<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produksi;
use App\Models\Pengiriman;
use App\Models\Karyawan;
use Carbon\Carbon; // Library untuk mengolah tanggal
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function adminIndex()
    {
        $today = Carbon::today();
        
        // --- 1. Hitung Data Produksi (Hari, Bulan, Tahun Ini) ---
        $prodHari  = Produksi::whereDate('Tanggal_produksi', $today)->sum('Jumlah_selesai');
        
        $prodBulan = Produksi::whereMonth('Tanggal_produksi', $today->month)
                             ->whereYear('Tanggal_produksi', $today->year)
                             ->sum('Jumlah_selesai');
                             
        $prodTahun = Produksi::whereYear('Tanggal_produksi', $today->year)
                             ->sum('Jumlah_selesai');

        // --- 2. Hitung Data Pengiriman (Hari, Bulan, Tahun Ini) ---
        // Kita hitung jumlah transaksinya (count)
        $kirimHari  = Pengiriman::whereDate('Tanggal_kirim', $today)->count();
        
        $kirimBulan = Pengiriman::whereMonth('Tanggal_kirim', $today->month)
                                ->whereYear('Tanggal_kirim', $today->year)
                                ->count();
                                
        $kirimTahun = Pengiriman::whereYear('Tanggal_kirim', $today->year)
                                ->count();

        // --- 3. Total Karyawan ---
        $totalKaryawan = Karyawan::count();

        return view('admin.dashboard', compact(
            'prodHari', 'prodBulan', 'prodTahun',
            'kirimHari', 'kirimBulan', 'kirimTahun', 'totalKaryawan'
        ));
    }

    // --- DASHBOARD KARYAWAN (Rekap Pribadi) ---
    public function karyawanIndex()
    {
        $id_karyawan = Auth::user()->Id_karyawan; // Ambil ID user yang sedang login

        // 1. Ambil 5 Data Produksi Terakhir milik user ini
        $riwayatProduksi = Produksi::with('produk')
                                   ->where('Id_karyawan', $id_karyawan) // Filter punya dia sendiri
                                   ->latest('Tanggal_produksi')
                                   ->limit(5)
                                   ->get();

        // 2. Ambil 5 Data Pengiriman Terakhir milik user ini
        $riwayatPengiriman = Pengiriman::with('pelanggan')
                                       ->where('Id_karyawan', $id_karyawan) // Filter punya dia sendiri
                                       ->latest('Tanggal_kirim')
                                       ->limit(5)
                                       ->get();

        return view('karyawan.dashboard', compact('riwayatProduksi', 'riwayatPengiriman'));
    }
}