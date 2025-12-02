<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengiriman;
use App\Models\DetailPengiriman;
use App\Models\Produk;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // Kita butuh ini untuk Transaksi Database

class PengirimanController extends Controller
{
    // 1. Tampilkan Form Input Pengiriman
    public function create()
    {
        $pelanggan = Pelanggan::all(); // Untuk dropdown pilih pelanggan
        $produk = Produk::all();       // Untuk dropdown pilih barang
        
        return view('karyawan.pengiriman.create', compact('pelanggan', 'produk'));
    }

    // 2. Simpan Data (Bagian Rumit)
    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'Id_pelanggan'  => 'required',
            'Tanggal_kirim' => 'required|date',
            // Validasi Array (Karena barangnya banyak)
            'Id_produk'     => 'required|array', 
            'Id_produk.*'   => 'required',
            'Jumlah_kirim'  => 'required|array',
            'Jumlah_kirim.*'=> 'required|integer|min:1',
        ]);

        // Gunakan DB Transaction agar jika satu gagal, semua batal (Data aman)
        DB::transaction(function () use ($request) {
            
            // A. Simpan ke Tabel Utama (Pengiriman)
            $pengiriman = Pengiriman::create([
                'Id_pelanggan'      => $request->Id_pelanggan,
                'Tanggal_kirim'     => $request->Tanggal_kirim,
                'Id_karyawan'       => Auth::id(), // Karyawan yang login
                'Status_pengiriman' => 'Dikirim',  // Default status
            ]);

            // B. Simpan ke Tabel Detail (Looping barang)
            // Kita ambil daftar produk yang dipilih dari form
            $produk_dipilih = $request->Id_produk; 

            foreach ($produk_dipilih as $index => $id_produk) {
                // Ambil jumlah yang sesuai dengan urutan produk
                $jumlah = $request->Jumlah_kirim[$index];

                DetailPengiriman::create([
                    'Id_pengiriman' => $pengiriman->Id_pengiriman, // Ambil ID dari proses A di atas
                    'Id_produk'     => $id_produk,
                    'Jumlah_kirim'  => $jumlah,
                    'keterangan'    => '-'
                ]);
            }
        });

        // Redirect dilakukan SETELAH transaksi selesai
        return redirect()->route('karyawan.dashboard')->with('success', 'Pengiriman berhasil diproses!');
    }

    // 3. Fungsi Selesaikan Pengiriman (Update Status)
    public function selesaikan($id)
    {
        // Cari data pengiriman berdasarkan ID
        // Dan pastikan yang mengubah adalah karyawan pemilik data itu sendiri (Keamanan)
        $pengiriman = Pengiriman::where('Id_pengiriman', $id)
                                ->where('Id_karyawan', Auth::id()) 
                                ->firstOrFail();

        // Ubah status jadi Selesai
        $pengiriman->Status_pengiriman = 'Selesai';
        $pengiriman->save();

        return back()->with('success', 'Status pengiriman berhasil diubah menjadi Selesai!');
    }
}