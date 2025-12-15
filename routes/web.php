<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth; 

Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->Id_hakakses == 1) {
            return redirect()->route('admin.dashboard');
        } 

        return redirect()->route('karyawan.dashboard');
    }
    return redirect()->route('login');
});

    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate']);

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

Route::middleware('auth')->group(function () {
    
    Route::get('/admin/dashboard', [App\Http\Controllers\DashboardController::class, 'adminIndex'])->name('admin.dashboard');

    Route::get('/karyawan/dashboard', [App\Http\Controllers\DashboardController::class, 'karyawanIndex'])->name('karyawan.dashboard');
    Route::get('/karyawan/input-produksi', [App\Http\Controllers\ProduksiController::class, 'create'])->name('produksi.create');
    Route::post('/karyawan/simpan-produksi', [App\Http\Controllers\ProduksiController::class, 'store'])->name('produksi.store');
    
    Route::get('/admin/karyawan', [App\Http\Controllers\KaryawanController::class, 'index'])->name('karyawan.index');
    Route::get('/admin/karyawan/create', [App\Http\Controllers\KaryawanController::class, 'create'])->name('karyawan.create');
    Route::post('/admin/karyawan', [App\Http\Controllers\KaryawanController::class, 'store'])->name('karyawan.store');
    Route::get('/admin/karyawan/{id}/edit', [App\Http\Controllers\KaryawanController::class, 'edit'])->name('karyawan.edit');
    Route::put('/admin/karyawan/{id}', [App\Http\Controllers\KaryawanController::class, 'update'])->name('karyawan.update');
    Route::delete('/admin/karyawan/{id}', [App\Http\Controllers\KaryawanController::class, 'destroy'])->name('karyawan.destroy');

    Route::get('/admin/produk', [App\Http\Controllers\ProdukController::class, 'index'])->name('produk.index');
    Route::get('/admin/produk/create', [App\Http\Controllers\ProdukController::class, 'create'])->name('produk.create');
    Route::post('/admin/produk', [App\Http\Controllers\ProdukController::class, 'store'])->name('produk.store');
    Route::get('/admin/produk/{id}/edit', [App\Http\Controllers\ProdukController::class, 'edit'])->name('produk.edit');
    Route::put('/admin/produk/{id}', [App\Http\Controllers\ProdukController::class, 'update'])->name('produk.update');
    Route::delete('/admin/produk/{id}', [App\Http\Controllers\ProdukController::class, 'destroy'])->name('produk.destroy');

    Route::get('/admin/pelanggan', [App\Http\Controllers\PelangganController::class, 'index'])->name('pelanggan.index');
    Route::get('/admin/pelanggan/create', [App\Http\Controllers\PelangganController::class, 'create'])->name('pelanggan.create');
    Route::post('/admin/pelanggan', [App\Http\Controllers\PelangganController::class, 'store'])->name('pelanggan.store');
    Route::get('/admin/pelanggan/{id}/edit', [App\Http\Controllers\PelangganController::class, 'edit'])->name('pelanggan.edit');
    Route::put('/admin/pelanggan/{id}', [App\Http\Controllers\PelangganController::class, 'update'])->name('pelanggan.update');
    Route::delete('/admin/pelanggan/{id}', [App\Http\Controllers\PelangganController::class, 'destroy'])->name('pelanggan.destroy');

    Route::get('/karyawan/input-pengiriman', [App\Http\Controllers\PengirimanController::class, 'create'])->name('pengiriman.create');
    Route::post('/karyawan/simpan-pengiriman', [App\Http\Controllers\PengirimanController::class, 'store'])->name('pengiriman.store');
    Route::put('/karyawan/pengiriman/{id}/selesai', [App\Http\Controllers\PengirimanController::class, 'selesaikan'])->name('pengiriman.selesai');

    Route::get('/admin/laporan', [App\Http\Controllers\LaporanController::class, 'index'])->name('laporan.index');
    Route::delete('/admin/laporan/produksi/{id}', [App\Http\Controllers\LaporanController::class, 'destroyProduksi'])->name('laporan.destroyProduksi');
    Route::delete('/admin/laporan/pengiriman/{id}', [App\Http\Controllers\LaporanController::class, 'destroyPengiriman'])->name('laporan.destroyPengiriman');
});