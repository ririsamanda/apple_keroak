<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
    
        DB::table('hak_akses')->updateOrInsert(
            ['Id_hakakses' => 1],
            ['Nama_hakakses' => 'Admin']
        );

        DB::table('hak_akses')->updateOrInsert(
            ['Id_hakakses' => 2],
            ['Nama_hakakses' => 'Karyawan']
        );

        DB::table('karyawan')->updateOrInsert(
            ['Username' => 'admin'], 
            [
                'Nama_karyawan' => 'Pak Haris (Chief Admin)',
                'Password'      => Hash::make('password'), 
                'Id_hakakses'   => 1, 
                'Jabatan'       => 'Plant Manager',
                'created_at'    => now(),
                'updated_at'    => now(),
            ]
        );
        
        DB::table('karyawan')->updateOrInsert(
            ['Username' => 'aulia'], 
            [
                'Nama_karyawan' => 'Aulia Siregar',
                'Password'      => Hash::make('12345'),
                'Id_hakakses'   => 1, // Admin
                'Jabatan'       => 'Quality Control Lead',
                'created_at'    => now(),
                'updated_at'    => now(),
            ]
        );

        DB::table('karyawan')->updateOrInsert(
            ['Username' => 'joko'], 
            [
                'Nama_karyawan' => 'Joko Santoso',
                'Password'      => Hash::make('password'),
                'Id_hakakses'   => 1, 
                'Jabatan'       => 'Supervisor Logistik',
                'created_at'    => now(),
                'updated_at'    => now(),
            ]
        );

        DB::table('karyawan')->updateOrInsert(
            ['Username' => 'budi'], 
            [
                'Nama_karyawan' => 'Budi Operator',
                'Password'      => Hash::make('password'),
                'Id_hakakses'   => 2, 
                'Jabatan'       => 'Operator Perakitan',
                'created_at'    => now(),
                'updated_at'    => now(),
            ]
        );

        DB::table('karyawan')->updateOrInsert(
            ['Username' => 'siti'], 
            [
                'Nama_karyawan' => 'Siti Aminah',
                'Password'      => Hash::make('password'),
                'Id_hakakses'   => 2, 
                'Jabatan'       => 'Staff Gudang Komponen',
                'created_at'    => now(),
                'updated_at'    => now(),
            ]
        );

        DB::table('produk')->updateOrInsert(
            ['Id_produk' => 1], 
            [
                'Nama_produk' => 'Phone X 17 Pro Max 512GB',
                'Kategori'    => 'Smartphone',
                'Satuan'      => 'Unit',
                'Harga'       => 45000000,
                'Stok'        => 100,         
                'created_at'  => now(),
                'updated_at'  => now(),
            ]
        );

        DB::table('produk')->updateOrInsert(
            ['Id_produk' => 2], 
            [
                'Nama_produk' => 'Laptop Alpha M5 14 Inch',
                'Kategori'    => 'Laptop',
                'Satuan'      => 'Unit',
                'Harga'       => 65000000,
                'Stok'        => 50,        
                'created_at'  => now(),
                'updated_at'  => now(),
            ]
        );

        DB::table('produk')->updateOrInsert(
            ['Id_produk' => 3], 
            [
                'Nama_produk' => 'Air Head Gen 3 - Black',
                'Kategori'    => 'Audio',
                'Satuan'      => 'Pcs',
                'Harga'       => 28000000,
                'Stok'        => 100,        
                'created_at'  => now(),
                'updated_at'  => now(),
            ]
        );

        DB::table('produk')->updateOrInsert(
            ['Id_produk' => 4], 
            [
                'Nama_produk' => 'Watch Pro Ultra Series 3',
                'Kategori'    => 'Wearable',
                'Satuan'      => 'Pcs',
                'Harga'       => 1500000,
                'Stok'        => 150,       
                'created_at'  => now(),
                'updated_at'  => now(),
            ]
        );

        DB::table('produk')->updateOrInsert(
            ['Id_produk' => 5], 
            [
                'Nama_produk' => 'Tablet Mini Max 10.9',
                'Kategori'    => 'Tablet',
                'Satuan'      => 'Unit',
                'Harga'       => 14000000,
                'Stok'        => 100,    
                'created_at'  => now(),
                'updated_at'  => now(),
            ]
        );

        
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

        DB::table('pelanggan')->updateOrInsert(
            ['Id_pelanggan' => 3], 
            [
                'Nama_pelanggan' => 'Global Gadget Store',
                'Alamat'         => 'Mall Ambassador Lt. 3, Jakarta Selatan',
                'No_telp'        => '021-57901234',
                'created_at'     => now(),
                'updated_at'     => now(),
            ]
        );

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

        DB::table('pelanggan')->updateOrInsert(
            ['Id_pelanggan' => 5], 
            [
                'Nama_pelanggan' => 'Universitas Teknologi Digital',
                'Alamat'         => 'Jl. Raya Bogor KM 20, Depok',
                'No_telp'        => '081311223344',
                'created_at'     => now(),
                'updated_at'     => now(),
            ]
        );
        
        DB::table('produksi')->updateOrInsert(
            ['Id_produksi' => 1],
            [
                'Id_produk'        => 1, 
                'Jumlah_selesai'   => 50, 
                'Tanggal_produksi' => '2025-11-01',
                'Id_karyawan'      => 2, 
                'keterangan'       => 'Batch 17 Pro Max Lolos QC Penuh, Siap Dikirim',
                'created_at'       => now(), 'updated_at' => now(),
            ]
        );

        DB::table('produksi')->updateOrInsert(
            ['Id_produksi' => 2],
            [
                'Id_produk'        => 3, 
                'Jumlah_selesai'   => 100,
                'Tanggal_produksi' => '2025-11-02',
                'Id_karyawan'      => 4, 
                'keterangan'       => 'Perakitan Headphone selesai, perlu cek audio final',
                'created_at'       => now(), 'updated_at' => now(),
            ]
        );

        DB::table('pengiriman')->updateOrInsert(
            ['Id_pengiriman' => 1],
            [
                'Id_pelanggan'      => 1, 
                'Tanggal_kirim'     => '2025-11-10',
                'Id_karyawan'       => 3, 
                'Status_pengiriman' => 'Dikirim',
                'created_at'        => now(), 'updated_at' => now(),
            ]
        );

        DB::table('pengiriman')->updateOrInsert(
            ['Id_pengiriman' => 2],
            [
                'Id_pelanggan'      => 3, 
                'Tanggal_kirim'     => '2025-11-12',
                'Id_karyawan'       => 3,
                'Status_pengiriman' => 'Selesai',
                'created_at'        => now(), 'updated_at' => now(),
            ]
        );


        DB::table('detail_pengiriman')->updateOrInsert(
            ['Id_detail' => 1],
            [
                'Id_pengiriman' => 1,
                'Id_produk'     => 1, 
                'Jumlah_kirim'  => 30, 
                'keterangan'    => 'Pengiriman menggunakan pallet standar',
                'created_at'    => now(), 'updated_at' => now(),
            ]
        );

        DB::table('detail_pengiriman')->updateOrInsert(
            ['Id_detail' => 2],
            [
                'Id_pengiriman' => 1,
                'Id_produk'     => 2, 
                'Jumlah_kirim'  => 10, 
                'keterangan'    => 'Wajib asuransi penuh',
                'created_at'    => now(), 'updated_at' => now(),
            ]
        );

        DB::table('detail_pengiriman')->updateOrInsert(
            ['Id_detail' => 3],
            [
                'Id_pengiriman' => 2,
                'Id_produk'     => 4, 
                'Jumlah_kirim'  => 50, 
                'keterangan'    => 'Pengiriman via kurir express',
                'created_at'    => now(), 'updated_at' => now(),
            ]
        );
    }
}