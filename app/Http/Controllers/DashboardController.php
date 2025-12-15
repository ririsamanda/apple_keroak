<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produksi;
use App\Models\Pengiriman;
use App\Models\Karyawan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function adminIndex()
    {
        $today = Carbon::today();
        
        $prodHari  = Produksi::whereDate('Tanggal_produksi', $today)->sum('Jumlah_selesai');
        
        $prodBulan = Produksi::whereMonth('Tanggal_produksi', $today->month)
                             ->whereYear('Tanggal_produksi', $today->year)
                             ->sum('Jumlah_selesai');
                             
        $prodTahun = Produksi::whereYear('Tanggal_produksi', $today->year)
                             ->sum('Jumlah_selesai');

        $kirimHari  = Pengiriman::whereDate('Tanggal_kirim', $today)->count();
        
        $kirimBulan = Pengiriman::whereMonth('Tanggal_kirim', $today->month)
                                ->whereYear('Tanggal_kirim', $today->year)
                                ->count();
                                
        $kirimTahun = Pengiriman::whereYear('Tanggal_kirim', $today->year)
                                ->count();

        $totalKaryawan = Karyawan::count();

        $chartLabels = [];
        $chartData   = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            
            $chartLabels[] = $date->translatedFormat('F'); 

            $total = Produksi::whereMonth('Tanggal_produksi', $date->month)
                             ->whereYear('Tanggal_produksi', $date->year)
                             ->sum('Jumlah_selesai');
            
            $chartData[] = $total;
        }

        return view('admin.dashboard', compact(
            'prodHari', 'prodBulan', 'prodTahun',
            'kirimHari', 'kirimBulan', 'kirimTahun', 'totalKaryawan',
            'chartLabels', 'chartData' 
        ));
    }

    public function karyawanIndex()
    {
        $id_karyawan = Auth::user()->Id_karyawan; 

        $riwayatProduksi = Produksi::with('produk')
                                   ->where('Id_karyawan', $id_karyawan)
                                   ->latest('Tanggal_produksi')
                                   ->limit(5)
                                   ->get();

        $riwayatPengiriman = Pengiriman::with('pelanggan')
                                       ->where('Id_karyawan', $id_karyawan)
                                       ->latest('Tanggal_kirim')
                                       ->limit(5)
                                       ->get();

        $chartLabels = [];
        $chartData   = [];
        
        $prodBulan = Produksi::where('Id_karyawan', $id_karyawan)
                             ->whereMonth('Tanggal_produksi', Carbon::now()->month)
                             ->sum('Jumlah_selesai');

        return view('karyawan.dashboard', compact(
            'riwayatProduksi', 'riwayatPengiriman', 'prodBulan'
        ));
    }
}