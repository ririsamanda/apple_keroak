<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // 1. Tampilkan Form Login
    public function index()
    {
        // PENCEGAH ERROR REDIRECT LOOP:
        // Jika user sudah login tapi malah buka halaman login, 
        // langsung lempar ke dashboard masing-masing.
        if (Auth::check()) {
            if (Auth::user()->Id_hakakses == 1) {
                return redirect()->intended('admin/dashboard');
            } else {
                return redirect()->intended('karyawan/dashboard');
            }
        }

        return view('login');
    }

    // 2. Proses Login
    public function authenticate(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'Username' => 'required',
            'Password' => 'required', // Ingat, name di form nanti harus 'Password'
        ]);

        // Coba login (Auth::attempt otomatis ngecek password hash)
        // Kita perlu mapping key karena Auth::attempt mencari 'password' (huruf kecil)
        // sedangkan di database kita 'Password' (huruf besar).
        // Tapi karena di Model Karyawan sudah kita set getAuthPassword,
        // kita cukup pass array credentialnya dengan benar.
        
        if (Auth::attempt(['Username' => $request->Username, 'password' => $request->Password])) {
            $request->session()->regenerate();

            // Cek Hak Akses untuk Redirect
            // Id_hakakses 1 = Admin, 2 = Karyawan
            $user = Auth::user();

            if ($user->Id_hakakses == 1) {
                return redirect()->intended('admin/dashboard');
            } else {
                return redirect()->intended('karyawan/dashboard');
            }
        }

        // Jika login gagal
        return back()->with('loginError', 'Login gagal! Username atau Password salah.');
    }

    // 3. Proses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}