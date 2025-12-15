<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Karyawan; 
use App\Models\HakAkses; 

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawan = Karyawan::with('hakAkses')->latest('Id_karyawan')->get();

        return view('admin.karyawan.index', compact('karyawan'));
    }

    public function create()
    {
        $hakAkses = HakAkses::all();
        return view('admin.karyawan.create', compact('hakAkses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nama_karyawan' => 'required|string|max:100',
            'Username'      => 'required|string|max:50|unique:karyawan,Username', 
            'Password'      => 'required|string|min:5',
            'Id_hakakses'   => 'required|exists:hak_akses,Id_hakakses',
            'Jabatan'       => 'required|string|max:100',
        ]);

        Karyawan::create([
            'Nama_karyawan' => $request->Nama_karyawan,
            'Username'      => $request->Username,
            'Password'      => Hash::make($request->Password), 
            'Id_hakakses'   => $request->Id_hakakses,
            'Jabatan'       => $request->Jabatan,
        ]);

        return redirect()->route('karyawan.index')->with('success', 'Data Karyawan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $karyawan = Karyawan::findOrFail($id); 
        $hakAkses = HakAkses::all();
        return view('admin.karyawan.edit', compact('karyawan', 'hakAkses'));
    }

    public function update(Request $request, $id)
    {
        $karyawan = Karyawan::findOrFail($id);

        $request->validate([
            'Nama_karyawan' => 'required|string|max:100',
            'Username'      => 'required|string|max:50|unique:karyawan,Username,'.$id.',Id_karyawan',
            'Id_hakakses'   => 'required',
            'Jabatan'       => 'required',
            'Password'      => 'nullable|string|min:5', 
        ]);

        $karyawan->Nama_karyawan = $request->Nama_karyawan;
        $karyawan->Username      = $request->Username;
        $karyawan->Id_hakakses   = $request->Id_hakakses;
        $karyawan->Jabatan       = $request->Jabatan;

        if ($request->filled('Password')) {
            $karyawan->Password = Hash::make($request->Password);
        }

        $karyawan->save();

        return redirect()->route('karyawan.index')->with('success', 'Data Karyawan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $karyawan->delete();

        return redirect()->route('karyawan.index')->with('success', 'Data Karyawan berhasil dihapus!');
    }
}