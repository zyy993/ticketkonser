<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Tampilkan halaman registrasi
    public function tampilRegistrasi()
    {
        return view('signup');
    }

    // Proses data registrasi
    public function submitRegistrasi(Request $request)
    {
        // Validasi sederhana (opsional, bisa ditambah)
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'no_hp' => 'required|string',
            'password' => 'required', // gunakan password_confirmation di form
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->no_hp = $request->no_hp;
        $user->password = bcrypt($request->password);
        $user->role = 'user'; // default role
        $user->save();

        return redirect()->route('login.tampil')->with('sukses', 'Registrasi berhasil. Silakan login.');
    }

    // Tampilkan halaman login
    public function tampilLogin()
    {
        return view('signin');
    }

    // Proses login
    public function submitLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Redirect berdasarkan role
            switch ($user->role) {
                case 'admin':
                    return redirect('/admin/dashboard');
                case 'promotor':
                    return redirect('/promotor/dashboard');
                case 'user':
                    return redirect('/home');
                default:
                    return redirect( '/home');
            }
        }

        return redirect()->back()->with('gagal', 'Email atau password salah.');
    }

    // Tampilkan halaman home (sementara/tidak wajib)
    public function tampilHome()
    {
        return view('user.home');
    }
}
