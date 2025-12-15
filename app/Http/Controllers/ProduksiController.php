<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produksi;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;

class ProduksiController extends Controller
{
    public function create()
    {
        $produk = Produk::all(); 
        return view('karyawan.produksi.create', compact('produk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Id_produk'        => 'required|exists:produk,Id_produk',
            'Jumlah_selesai'   => 'required|integer|min:1',
            'Tanggal_produksi' => 'required|date',
            'keterangan'       => 'nullable|string'
        ]);

        Produksi::create([
            'Id_produk'        => $request->Id_produk,
            'Jumlah_selesai'   => $request->Jumlah_selesai,
            'Tanggal_produksi' => $request->Tanggal_produksi,
            'Id_karyawan'      => Auth::id(), 
            'keterangan'       => $request->keterangan
        ]);

        return redirect()->route('karyawan.dashboard')->with('success', 'Data produksi berhasil disimpan!');
    }
}