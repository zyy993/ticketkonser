<?php

namespace App\Http\Controllers;
use App\Models\Chat;
 use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LiveChatController extends Controller
{


public function adminView()
{
    // Ambil hanya ID unik dari tabel Chat
    $userIds = Chat::distinct()->pluck('user_id');

    // Ambil data User dari ID yang ditemukan
    $users = User::whereIn('id', $userIds)->get();

    return view('admin.livechat2', compact('users'));
}

    public function adminSend(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'message' => 'required|string',
        ]);

        Chat::create([
            'user_id' => $request->user_id,
            'message' => $request->message,
            'role'    => 'admin',
        ]);

        return back()->with('success', 'Pesan terkirim');
    }
}
