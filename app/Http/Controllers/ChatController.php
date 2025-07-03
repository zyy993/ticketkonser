<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        // Ambil chat hanya milik user saat ini dan pesan admin global
        $chats = Chat::where('user_id', $userId)
            ->orWhereNull('user_id') // untuk pesan balasan admin
            ->orderBy('created_at')
            ->get();

        return view('user.livechat', compact('chats'));
    }

    public function store(Request $request)
    {
        $userId = auth()->id();

        // Simpan pesan user
        Chat::create([
            'user_id' => $userId,
            'message' => $request->message,
            'role'    => 'user',
        ]);

        // Cek apakah sudah ada balasan admin untuk user ini
        $alreadyReplied = Chat::where('user_id', $userId)
            ->where('role', 'admin')
            ->exists();

        // Hanya balas jika belum ada balasan admin untuk user ini
        if (!$alreadyReplied) {
            Chat::create([
                'user_id' => $userId,
                'message' => 'Terima kasih, permintaan Anda akan segera ditanggapi.',
                'role'    => 'admin',
            ]);
        }

        return response()->json(['success' => true]);
    }

    public function adminSend(Request $request)
    {
        $request->validate([
            'message' => 'required|string'
        ]);

        Chat::create([
            'user_id' => auth()->id(), // bisa disesuaikan jika ingin ditujukan ke user tertentu
            'message' => $request->message,
            'role'    => 'admin'
        ]);

        return redirect()->route('admin.livechat');
    }

    // Endpoint untuk AJAX jika digunakan
    public function getChats()
    {
        $userId = auth()->id();

        $chats = Chat::where('user_id', $userId)
            ->orWhereNull('user_id')
            ->orderBy('created_at')
            ->get();

        return response()->json($chats);
    }
}
