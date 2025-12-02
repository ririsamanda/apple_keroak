<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth; // Tambahkan ini di paling atas file jika belum ada

// 1. Halaman Utama (Redirect ke Login)
Route::get('/', function () {
    // Cek jika user sudah login
    if (Auth::check()) {
        // Jika Admin, lempar ke dashboard admin
        if (Auth::user()->Id_hakakses == 1) {
            return redirect()->route('admin.dashboard');
        } 
        // Jika Karyawan, lempar ke dashboard karyawan
        return redirect()->route('karyawan.dashboard');
    }
    // Jika belum login, baru lempar ke login
    return redirect()->route('login');
});

// 2. Route untuk Login & Logout (Akses Tamu/Guest)
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate']);

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

// 3. Route untuk Dashboard (Wajib Login)
Route::middleware('auth')->group(function () {
    
    // Dashboard Admin (Sekarang pakai Controller)
    Route::get('/admin/dashboard', [App\Http\Controllers\DashboardController::class, 'adminIndex'])->name('admin.dashboard');

    // Dashboard Karyawan (Sekarang pakai Controller agar ada datanya)
    Route::get('/karyawan/dashboard', [App\Http\Controllers\DashboardController::class, 'karyawanIndex'])->name('karyawan.dashboard');

    // --- ROUTE KARYAWAN PRODUKSI ---
    Route::get('/karyawan/input-produksi', [App\Http\Controllers\ProduksiController::class, 'create'])->name('produksi.create');
    Route::post('/karyawan/simpan-produksi', [App\Http\Controllers\ProduksiController::class, 'store'])->name('produksi.store');
    
    // Route Kelola Karyawan
    Route::get('/admin/karyawan', [App\Http\Controllers\KaryawanController::class, 'index'])->name('karyawan.index');

    // 1. Form Tambah Karyawan
    Route::get('/admin/karyawan/create', [App\Http\Controllers\KaryawanController::class, 'create'])->name('karyawan.create');

    // 2. Proses Simpan Data
    Route::post('/admin/karyawan', [App\Http\Controllers\KaryawanController::class, 'store'])->name('karyawan.store');

    // 3. Form Edit
    Route::get('/admin/karyawan/{id}/edit', [App\Http\Controllers\KaryawanController::class, 'edit'])->name('karyawan.edit');
    
    // 4. Proses Update
    Route::put('/admin/karyawan/{id}', [App\Http\Controllers\KaryawanController::class, 'update'])->name('karyawan.update');
    
    // 5. Proses Hapus
    Route::delete('/admin/karyawan/{id}', [App\Http\Controllers\KaryawanController::class, 'destroy'])->name('karyawan.destroy');

    // --- ROUTE KELOLA PRODUK ---
    Route::get('/admin/produk', [App\Http\Controllers\ProdukController::class, 'index'])->name('produk.index');
    Route::get('/admin/produk/create', [App\Http\Controllers\ProdukController::class, 'create'])->name('produk.create');
    Route::post('/admin/produk', [App\Http\Controllers\ProdukController::class, 'store'])->name('produk.store');
    Route::get('/admin/produk/{id}/edit', [App\Http\Controllers\ProdukController::class, 'edit'])->name('produk.edit');
    Route::put('/admin/produk/{id}', [App\Http\Controllers\ProdukController::class, 'update'])->name('produk.update');
    Route::delete('/admin/produk/{id}', [App\Http\Controllers\ProdukController::class, 'destroy'])->name('produk.destroy');

    // --- ROUTE KELOLA PELANGGAN ---
    Route::get('/admin/pelanggan', [App\Http\Controllers\PelangganController::class, 'index'])->name('pelanggan.index');
    Route::get('/admin/pelanggan/create', [App\Http\Controllers\PelangganController::class, 'create'])->name('pelanggan.create');
    Route::post('/admin/pelanggan', [App\Http\Controllers\PelangganController::class, 'store'])->name('pelanggan.store');
    Route::get('/admin/pelanggan/{id}/edit', [App\Http\Controllers\PelangganController::class, 'edit'])->name('pelanggan.edit');
    Route::put('/admin/pelanggan/{id}', [App\Http\Controllers\PelangganController::class, 'update'])->name('pelanggan.update');
    Route::delete('/admin/pelanggan/{id}', [App\Http\Controllers\PelangganController::class, 'destroy'])->name('pelanggan.destroy');

    // --- ROUTE PENGIRIMAN ---
    Route::get('/karyawan/input-pengiriman', [App\Http\Controllers\PengirimanController::class, 'create'])->name('pengiriman.create');
    Route::post('/karyawan/simpan-pengiriman', [App\Http\Controllers\PengirimanController::class, 'store'])->name('pengiriman.store');
    // Route Update Status Selesai (Khusus Karyawan)
    Route::put('/karyawan/pengiriman/{id}/selesai', [App\Http\Controllers\PengirimanController::class, 'selesaikan'])->name('pengiriman.selesai');

    // --- ROUTE LAPORAN ---
    Route::get('/admin/laporan', [App\Http\Controllers\LaporanController::class, 'index'])->name('laporan.index');

    // Route Hapus Laporan
    Route::delete('/admin/laporan/produksi/{id}', [App\Http\Controllers\LaporanController::class, 'destroyProduksi'])->name('laporan.destroyProduksi');
    Route::delete('/admin/laporan/pengiriman/{id}', [App\Http\Controllers\LaporanController::class, 'destroyPengiriman'])->name('laporan.destroyPengiriman');
});