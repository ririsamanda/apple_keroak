<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukController extends Controller
{
    // 1. Tampilkan Semua Produk
    public function index()
    {
        $produk = Produk::latest('Id_produk')->get();
        return view('admin.produk.index', compact('produk'));
    }

    // 2. Form Tambah
    public function create()
    {
        return view('admin.produk.create');
    }

    // 3. Simpan Data
    public function store(Request $request)
    {
        $request->validate([
            'Nama_produk' => 'required|string|max:100',
            'Kategori'    => 'required|string|max:100',
            'Satuan'      => 'required|string|max:50',
            'Harga'       => 'required|numeric|min:0',
        ]);

        Produk::create($request->all());

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    // 4. Form Edit
    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        return view('admin.produk.edit', compact('produk'));
    }

    // 5. Update Data
    public function update(Request $request, $id)
    {
        $request->validate([
            'Nama_produk' => 'required|string|max:100',
            'Kategori'    => 'required|string|max:100',
            'Satuan'      => 'required|string|max:50',
            'Harga'       => 'required|numeric|min:0',
        ]);

        $produk = Produk::findOrFail($id);
        $produk->update($request->all());

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui!');
    }

    // 6. Hapus Data
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus!');
    }
}