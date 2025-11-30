<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ==========================================
        // 1. ISI TABEL HAK AKSES (Paten)
        // ==========================================
        DB::table('hak_akses')->updateOrInsert(
            ['Id_hakakses' => 1],
            ['Nama_hakakses' => 'Admin']
        );

        DB::table('hak_akses')->updateOrInsert(
            ['Id_hakakses' => 2],
            ['Nama_hakakses' => 'Karyawan']
        );

        // ==========================================
        // 2. ISI TABEL KARYAWAN (5 DATA)
        // ==========================================
        
        // --- DATA 1: Super Admin (Admin) ---
        DB::table('karyawan')->updateOrInsert(
            ['Username' => 'admin'], // Kunci unik
            [
                'Nama_karyawan' => 'Bpk. Bos Keroak',
                'Password'      => Hash::make('password'), 
                'Id_hakakses'   => 1, // Admin
                'Jabatan'       => 'Store Manager',
                'created_at'    => now(),
                'updated_at'    => now(),
            ]
        );
        
        // --- DATA 2: Riris Amanda (Admin) ---
        DB::table('karyawan')->updateOrInsert(
            ['Username' => 'riris'], 
            [
                'Nama_karyawan' => 'Riris Amanda',
                'Password'      => Hash::make('12345'),
                'Id_hakakses'   => 1, // Admin
                'Jabatan'       => 'Senior Sales',
                'created_at'    => now(),
                'updated_at'    => now(),
            ]
        );

        // --- DATA 3: Joko Supervisor (Admin) ---
        DB::table('karyawan')->updateOrInsert(
            ['Username' => 'joko'], 
            [
                'Nama_karyawan' => 'Joko Santoso',
                'Password'      => Hash::make('password'),
                'Id_hakakses'   => 1, // Admin (Level Supervisor)
                'Jabatan'       => 'Supervisor Gudang',
                'created_at'    => now(),
                'updated_at'    => now(),
            ]
        );

        // --- DATA 4: Budi Operator (Karyawan) ---
        DB::table('karyawan')->updateOrInsert(
            ['Username' => 'budi'], 
            [
                'Nama_karyawan' => 'Budi Operator',
                'Password'      => Hash::make('password'),
                'Id_hakakses'   => 2, // Karyawan
                'Jabatan'       => 'Operator Mesin',
                'created_at'    => now(),
                'updated_at'    => now(),
            ]
        );

        // --- DATA 5: Siti Staff (Karyawan) ---
        DB::table('karyawan')->updateOrInsert(
            ['Username' => 'siti'], 
            [
                'Nama_karyawan' => 'Siti Aminah',
                'Password'      => Hash::make('password'),
                'Id_hakakses'   => 2, // Karyawan
                'Jabatan'       => 'Staff Administrasi',
                'created_at'    => now(),
                'updated_at'    => now(),
            ]
        );

        // ==========================================
        // 3. ISI TABEL PRODUK (LENGKAP DENGAN STOK)
        // ==========================================
        
        // Produk 1: Laptop (Stok 5)
        DB::table('produk')->updateOrInsert(
            ['Id_produk' => 1], 
            [
                'Nama_produk' => 'MacBook Pro M3 Max 16',
                'Kategori'    => 'Apple',
                'Satuan'      => 'Unit',
                'Harga'       => 45000000,
                'Stok'        => 10,         // <-- Stok sudah masuk
                'created_at'  => now(),
                'updated_at'  => now(),
            ]
        );

        // Produk 2: Laptop Gaming (Stok 5)
        DB::table('produk')->updateOrInsert(
            ['Id_produk' => 2], 
            [
                'Nama_produk' => 'Asus ROG Strix Scar 18',
                'Kategori'    => 'Laptop Gaming',
                'Satuan'      => 'Unit',
                'Harga'       => 65000000,
                'Stok'        => 5,        // <-- Stok sudah masuk
                'created_at'  => now(),
                'updated_at'  => now(),
            ]
        );

        // Produk 3: Laptop Bisnis
        DB::table('produk')->updateOrInsert(
            ['Id_produk' => 3], 
            [
                'Nama_produk' => 'Lenovo ThinkPad X1 Carbon',
                'Kategori'    => 'Ultrabook',
                'Satuan'      => 'Pcs',
                'Harga'       => 28000000,
                'Stok'        => 20,        // <-- Stok sudah masuk
                'created_at'  => now(),
                'updated_at'  => now(),
            ]
        );

        // Produk 4: Aksesoris Mouse (Stok 50)
        DB::table('produk')->updateOrInsert(
            ['Id_produk' => 4], 
            [
                'Nama_produk' => 'Apple Magic Mouse 2 - Black',
                'Kategori'    => 'Aksesoris',
                'Satuan'      => 'Pcs',
                'Harga'       => 1500000,
                'Stok'        => 50,        // <-- Stok sudah masuk
                'created_at'  => now(),
                'updated_at'  => now(),
            ]
        );

        // Produk 5: Monitor (Stok 100)
        DB::table('produk')->updateOrInsert(
            ['Id_produk' => 5], 
            [
                'Nama_produk' => 'LG UltraGear OLED 27"',
                'Kategori'    => 'Monitor',
                'Satuan'      => 'Unit',
                'Harga'       => 14000000,
                'Stok'        => 100,       // <-- Stok sudah masuk
                'created_at'  => now(),
                'updated_at'  => now(),
            ]
        );

        // ==========================================
        // 4. ISI TABEL PELANGGAN (DATA BARU)
        // ==========================================
        // Acuan: Id_pelanggan
        
        // Pelanggan 1 (Toko)
        DB::table('pelanggan')->updateOrInsert(
            ['Id_pelanggan' => 1], 
            [
                'Nama_pelanggan' => 'CV. Solusi Digital (Reseller)',
                'Alamat'         => 'Jl. Jendral Sudirman No. 10, Jakarta Pusat',
                'No_telp'        => '081234567890',
                'created_at'     => now(),
                'updated_at'     => now(),
            ]
        );

        // Pelanggan 2 (CV)
        DB::table('pelanggan')->updateOrInsert(
            ['Id_pelanggan' => 2], 
            [
                'Nama_pelanggan' => 'PT. Startup Unicorn Indonesia',
                'Alamat'         => 'Kawasan Industri Pulogadung Blok A2, Jakarta Timur',
                'No_telp'        => '021-4601234',
                'created_at'     => now(),
                'updated_at'     => now(),
            ]
        );

        // Pelanggan 3 (Perorangan)
        DB::table('pelanggan')->updateOrInsert(
            ['Id_pelanggan' => 3], 
            [
                'Nama_pelanggan' => 'Budi Santoso',
                'Alamat'         => 'Jl. Kebon Jeruk No. 88, Jakarta Barat',
                'No_telp'        => '085798765432',
                'created_at'     => now(),
                'updated_at'     => now(),
            ]
        );

        // Pelanggan 4 (PT)
        DB::table('pelanggan')->updateOrInsert(
            ['Id_pelanggan' => 4], 
            [
                'Nama_pelanggan' => 'PT. Teknologi Masa Depan',
                'Alamat'         => 'Gedung Cyber Lt. 5, Jl. Kuningan Barat, Jakarta Selatan',
                'No_telp'        => '021-5205555',
                'created_at'     => now(),
                'updated_at'     => now(),
            ]
        );

        // Pelanggan 5 (Perorangan)
        DB::table('pelanggan')->updateOrInsert(
            ['Id_pelanggan' => 5], 
            [
                'Nama_pelanggan' => 'Siti Aminah',
                'Alamat'         => 'Komplek Gading Serpong Sektor 1A, Tangerang',
                'No_telp'        => '081311223344',
                'created_at'     => now(),
                'updated_at'     => now(),
            ]
        );

        // ==========================================
        // 4. PRODUKSI / QC (Quality Control Barang Masuk)
        // ==========================================
        // Di konteks toko, "Produksi" bisa dianggap sebagai "Setup/QC Laptop Baru"
        
        DB::table('produksi')->updateOrInsert(
            ['Id_produksi' => 1],
            [
                'Id_produk'        => 1, // MacBook Pro
                'Jumlah_selesai'   => 5, // 5 Unit selesai QC/Install OS
                'Tanggal_produksi' => '2025-11-01',
                'Id_karyawan'      => 2, // Sales/Teknisi yang cek
                'keterangan'       => 'QC Lolos, Garansi Aktif',
                'created_at'       => now(), 'updated_at' => now(),
            ]
        );

        DB::table('produksi')->updateOrInsert(
            ['Id_produksi' => 2],
            [
                'Id_produk'        => 2, // ROG
                'Jumlah_selesai'   => 3,
                'Tanggal_produksi' => '2025-11-02',
                'Id_karyawan'      => 2, 
                'keterangan'       => 'Upgrade RAM ke 64GB request user',
                'created_at'       => now(), 'updated_at' => now(),
            ]
        );

        // ==========================================
        // 5. PENGIRIMAN (DISTRIBUSI KE KLIEN)
        // ==========================================

        // Kirim ke Kantor Startup (Bulk Order)
        DB::table('pengiriman')->updateOrInsert(
            ['Id_pengiriman' => 1],
            [
                'Id_pelanggan'      => 2, // PT. Startup Unicorn
                'Tanggal_kirim'     => '2025-11-10',
                'Id_karyawan'       => 1, // Manager ACC
                'Status_pengiriman' => 'Dikirim',
                'created_at'        => now(), 'updated_at' => now(),
            ]
        );

        // Kirim ke Reseller Mangga Dua
        DB::table('pengiriman')->updateOrInsert(
            ['Id_pengiriman' => 2],
            [
                'Id_pelanggan'      => 1, // CV. Solusi Digital
                'Tanggal_kirim'     => '2025-11-12',
                'Id_karyawan'       => 1,
                'Status_pengiriman' => 'Selesai',
                'created_at'        => now(), 'updated_at' => now(),
            ]
        );

        // ==========================================
        // 6. DETAIL PENGIRIMAN
        // ==========================================

        // Detail Order PT Startup (Beli Laptop Kerja)
        DB::table('detail_pengiriman')->updateOrInsert(
            ['Id_detail' => 1],
            [
                'Id_pengiriman' => 1,
                'Id_produk'     => 1, // MacBook Pro
                'Jumlah_kirim'  => 3, // Beli 3 Unit
                'keterangan'    => 'Warna Space Black',
                'created_at'    => now(), 'updated_at' => now(),
            ]
        );

        DB::table('detail_pengiriman')->updateOrInsert(
            ['Id_detail' => 2],
            [
                'Id_pengiriman' => 1,
                'Id_produk'     => 5, // Monitor LG
                'Jumlah_kirim'  => 3, // Beli 3 Unit juga
                'keterangan'    => 'Packing Kayu Wajib',
                'created_at'    => now(), 'updated_at' => now(),
            ]
        );

        // Detail Order Reseller (Restock Aksesoris)
        DB::table('detail_pengiriman')->updateOrInsert(
            ['Id_detail' => 3],
            [
                'Id_pengiriman' => 2,
                'Id_produk'     => 4, // Mouse Apple
                'Jumlah_kirim'  => 20, // Borong 20 pcs
                'keterangan'    => null,
                'created_at'    => now(), 'updated_at' => now(),
            ]
        );
    }
}