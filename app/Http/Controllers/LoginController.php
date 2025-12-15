<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->Id_hakakses == 1) {
                return redirect()->intended('admin/dashboard');
            } else {
                return redirect()->intended('karyawan/dashboard');
            }
        }

        return view('login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'Username' => 'required',
            'Password' => 'required', 
        ]);
        
        if (Auth::attempt(['Username' => $request->Username, 'password' => $request->Password])) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->Id_hakakses == 1) {
                return redirect()->intended('admin/dashboard');
            } else {
                return redirect()->intended('karyawan/dashboard');
            }
        }

        return back()->with('loginError', 'Login gagal! Username atau Password salah.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}