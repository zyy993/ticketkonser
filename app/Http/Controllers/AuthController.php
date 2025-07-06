<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

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

    public function tampiladmin1()
    {
        return view('admin.haladmin');
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
                    return redirect( '/');
            }
        }

        return redirect()->back()->with('gagal', 'Email atau password salah.');
    }

    // Tampilkan halaman home (sementara/tidak wajib)
    public function tampilHome()
    {
        return view('user.home');
    }



public function updateProfile(Request $request)
{
     /** @var \App\Models\User $user */
$user = Auth::user();

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'no_hp' => 'nullable|string|max:20',
        'password' => 'nullable|min:6',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $user->name = $request->name;
    $user->email = $request->email;
    $user->no_hp = $request->no_hp;

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    // ⬇️ Simpan gambar jika ada
    if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('foto', $filename, 'public');
        $user->foto = $path;
    }

    $user->save();

    return redirect('/home')->with('success', 'Profile updated successfully!');
}

public function destroy(Request $request): RedirectResponse
{
    Auth::guard('web')->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/'); // arahkan ke halaman utama
}
public function editProfile()
    {
        return view('admin.editprofile3');
    }

public function updateProfile3(Request $request)
{
     /** @var \App\Models\User $user */
$user = Auth::user();

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'no_hp' => 'nullable|string|max:20',
        'password' => 'nullable|min:6',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $user->name = $request->name;
    $user->email = $request->email;
    $user->no_hp = $request->no_hp;

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    // ⬇️ Simpan gambar jika ada
    if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('foto', $filename, 'public');
        $user->foto = $path;
    }

    $user->save();

    return redirect('/admin/dashboard')->with('success', 'Profile updated successfully!');
}


}
