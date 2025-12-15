<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengiriman;
use App\Models\DetailPengiriman;
use App\Models\Produk;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; 

class PengirimanController extends Controller
{
    public function create()
    {
        $pelanggan = Pelanggan::all(); 
        $produk = Produk::all();      
        
        return view('karyawan.pengiriman.create', compact('pelanggan', 'produk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Id_pelanggan'  => 'required',
            'Tanggal_kirim' => 'required|date',
            'Id_produk'     => 'required|array', 
            'Id_produk.*'   => 'required',
            'Jumlah_kirim'  => 'required|array',
            'Jumlah_kirim.*'=> 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request) {
            
            $pengiriman = Pengiriman::create([
                'Id_pelanggan'      => $request->Id_pelanggan,
                'Tanggal_kirim'     => $request->Tanggal_kirim,
                'Id_karyawan'       => Auth::id(), 
                'Status_pengiriman' => 'Dikirim',  
            ]);

            $produk_dipilih = $request->Id_produk; 

            foreach ($produk_dipilih as $index => $id_produk) {
                $jumlah = $request->Jumlah_kirim[$index];

                DetailPengiriman::create([
                    'Id_pengiriman' => $pengiriman->Id_pengiriman, 
                    'Id_produk'     => $id_produk,
                    'Jumlah_kirim'  => $jumlah,
                    'keterangan'    => '-'
                ]);
            }
        });

        return redirect()->route('karyawan.dashboard')->with('success', 'Pengiriman berhasil diproses!');
    }

    public function selesaikan($id)
    {
        $pengiriman = Pengiriman::where('Id_pengiriman', $id)
                                ->where('Id_karyawan', Auth::id()) 
                                ->firstOrFail();

        $pengiriman->Status_pengiriman = 'Selesai';
        $pengiriman->save();

        return back()->with('success', 'Status pengiriman berhasil diubah menjadi Selesai!');
    }
}