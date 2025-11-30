<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Karyawan; // Panggil Model Karyawan
use App\Models\HakAkses; // Panggil Model Hak Akses (untuk filter/tambah nanti)

class KaryawanController extends Controller
{
    // 1. Menampilkan Daftar Karyawan
    public function index()
    {
        // Ambil semua data karyawan, urutkan dari yang terbaru
        // 'with' digunakan untuk mengambil relasi hakAkses agar tidak berat (Eager Loading)
        $karyawan = Karyawan::with('hakAkses')->latest('Id_karyawan')->get();

        return view('admin.karyawan.index', compact('karyawan'));
    }

    // 2. Menampilkan Form Tambah
    public function create()
    {
        // Kita butuh data hak akses untuk dropdown pilihan (Admin/Karyawan)
        $hakAkses = HakAkses::all();
        return view('admin.karyawan.create', compact('hakAkses'));
    }

    // 3. Menyimpan Data ke Database
    public function store(Request $request)
    {
        // Validasi Input
        $request->validate([
            'Nama_karyawan' => 'required|string|max:100',
            'Username'      => 'required|string|max:50|unique:karyawan,Username', // Unik di tabel karyawan
            'Password'      => 'required|string|min:5',
            'Id_hakakses'   => 'required|exists:hak_akses,Id_hakakses',
            'Jabatan'       => 'required|string|max:100',
        ]);

        // Simpan ke Database
        Karyawan::create([
            'Nama_karyawan' => $request->Nama_karyawan,
            'Username'      => $request->Username,
            'Password'      => Hash::make($request->Password), // Password wajib di-hash
            'Id_hakakses'   => $request->Id_hakakses,
            'Jabatan'       => $request->Jabatan,
        ]);

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('karyawan.index')->with('success', 'Data Karyawan berhasil ditambahkan!');
    }

    // 4. Menampilkan Form Edit
    public function edit($id)
    {
        $karyawan = Karyawan::findOrFail($id); // Cari user berdasarkan ID
        $hakAkses = HakAkses::all();
        return view('admin.karyawan.edit', compact('karyawan', 'hakAkses'));
    }

    // 5. Menyimpan Perubahan (Update)
    public function update(Request $request, $id)
    {
        $karyawan = Karyawan::findOrFail($id);

        $request->validate([
            'Nama_karyawan' => 'required|string|max:100',
            // Username harus unik, TAPI kecualikan untuk user ini sendiri
            'Username'      => 'required|string|max:50|unique:karyawan,Username,'.$id.',Id_karyawan',
            'Id_hakakses'   => 'required',
            'Jabatan'       => 'required',
            // Password boleh kosong jika tidak ingin diganti
            'Password'      => 'nullable|string|min:5', 
        ]);

        // Update data dasar
        $karyawan->Nama_karyawan = $request->Nama_karyawan;
        $karyawan->Username      = $request->Username;
        $karyawan->Id_hakakses   = $request->Id_hakakses;
        $karyawan->Jabatan       = $request->Jabatan;

        // Cek apakah password diisi? Jika ya, update & encrypt baru. Jika tidak, biarkan yang lama.
        if ($request->filled('Password')) {
            $karyawan->Password = Hash::make($request->Password);
        }

        $karyawan->save();

        return redirect()->route('karyawan.index')->with('success', 'Data Karyawan berhasil diperbarui!');
    }

    // 6. Menghapus Data
    public function destroy($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $karyawan->delete();

        return redirect()->route('karyawan.index')->with('success', 'Data Karyawan berhasil dihapus!');
    }
}