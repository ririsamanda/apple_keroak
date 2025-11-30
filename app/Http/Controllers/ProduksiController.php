<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produksi;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;

class ProduksiController extends Controller
{
    // 1. Tampilkan Form Input Produksi
    public function create()
    {
        $produk = Produk::all(); // Ambil semua data produk untuk dropdown
        return view('karyawan.produksi.create', compact('produk'));
    }

    // 2. Simpan Data Produksi
    public function store(Request $request)
    {
        $request->validate([
            'Id_produk'        => 'required|exists:produk,Id_produk',
            'Jumlah_selesai'   => 'required|integer|min:1',
            'Tanggal_produksi' => 'required|date',
            'keterangan'       => 'nullable|string'
        ]);

        // Simpan data
        Produksi::create([
            'Id_produk'        => $request->Id_produk,
            'Jumlah_selesai'   => $request->Jumlah_selesai,
            'Tanggal_produksi' => $request->Tanggal_produksi,
            'Id_karyawan'      => Auth::id(), // Otomatis ambil ID karyawan yang sedang login
            'keterangan'       => $request->keterangan
        ]);

        return redirect()->route('karyawan.dashboard')->with('success', 'Data produksi berhasil disimpan!');
    }
}