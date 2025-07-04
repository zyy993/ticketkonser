<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Mail\OtpMail;

class OtpController extends Controller
{
    public function register(Request $request)
    {
        // dd($request->all()); // akan tampil semua inputan dari form
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'no_hp' => 'required',
            'password' => 'required|min:6',
        ]);

        $otp = rand(100000, 999999);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'password' => Hash::make($request->password),
            'otp' => $otp,
            'role' => 'user',
        ]);



        Mail::to($user->email)->send(new OtpMail($otp));

        return view('verif', ['email' => $user->email]);
    }

    public function sendOtp(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan.']);
        }

        $otp = rand(100000, 999999);
        $user->otp = $otp;
        $user->save();

        Mail::to($user->email)->send(new OtpMail($otp));

        return view('verif', ['email' => $user->email]);
    }

    public function verifyOtp(Request $request)
{
    $request->validate([
        'otp' => 'required|array|size:6',
        'otp.*' => 'required|digits:1',
        'email' => 'required|email'
    ]);

    $otpInput = implode('', $request->otp);

    $user = User::where('email', $request->email)
                ->where('otp', $otpInput)
                ->first();

    if (!$user) {
        return back()->withErrors(['otp' => 'Kode OTP salah.']);
    }

    // Tandai email sebagai terverifikasi
    $user->email_verified_at = now();
    $user->otp = null;
    $user->save();

    return redirect()->route('login.tampil')->with('sukses', 'Email berhasil diverifikasi, silakan login.');
}

}
