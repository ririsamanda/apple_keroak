<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Isi Tabel Hak Akses
        // Id 1 = Admin, Id 2 = Karyawan
        DB::table('hak_akses')->insert([
            ['Id_hakakses' => 1, 'Nama_hakakses' => 'Admin'],
            ['Id_hakakses' => 2, 'Nama_hakakses' => 'Karyawan'],
        ]);

        // 2. Isi Tabel Karyawan (Buat 1 Akun Admin)
        // Username: admin, Password: password
        DB::table('karyawan')->insert([
            'Nama_karyawan' => 'Super Admin',
            'Username' => 'admin',
            'Password' => Hash::make('password'), // Password wajib di-hash (dienkripsi)
            'Id_hakakses' => 1, // Mengacu ke Id_hakakses 1 (Admin)
            'Jabatan' => 'IT Manager',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        // Opsional: Buat 1 Akun Karyawan dummy
        DB::table('karyawan')->insert([
            'Nama_karyawan' => 'Budi Operator',
            'Username' => 'budi',
            'Password' => Hash::make('password'),
            'Id_hakakses' => 2, // Karyawan
            'Jabatan' => 'Operator Produksi',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}