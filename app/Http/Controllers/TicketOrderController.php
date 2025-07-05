<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TicketOrder;
use App\Models\TicketType;
use Illuminate\Support\Facades\Auth;

class TicketOrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'ticket_id'  => 'required|exists:ticket_types,id',
            'seat_name'  => 'required|string|max:255',
        ]);

        // Ambil data tiket
        $ticket = TicketType::findOrFail($request->ticket_id);

        // Harga seat berdasarkan seat_name (hardcoded atau bisa juga dari tabel lain)
        $hargaSeat = match (strtoupper($request->seat_name)) {
            'ZONE A' => 10000,
            'ZONE B' => 8000,
            'ZONE C' => 6000,
            'ZONE D' => 5000,
            'VVIP'   => 15000,
            default  => 0,
        };

        $hargaTiket = $ticket->harga;
        $totalHarga = $hargaTiket + $hargaSeat;

        // Simpan ke database
        TicketOrder::create([
            'user_id'     => Auth::id(), // pastikan user login
            'ticket_id'   => $ticket->id,
            'seat_name'   => $request->seat_name,
            'harga_tiket' => $hargaTiket,
            'harga_seat'  => $hargaSeat,
            'total_harga' => $totalHarga,
        ]);

        return redirect()->route('home.tampil')->with('success', 'Tiket berhasil dipesan!');
    }

public function paymentConfirmation()
{
    $orders = TicketOrder::with(['ticket.event'])
        ->orderBy('created_at', 'desc')
        ->get();

    return view('admin.payment_confirmation', compact('orders'));
}

public function acceptPayment($id)
{
    $order = TicketOrder::findOrFail($id);
    $order->status = 'accepted';
    $order->save();

    return redirect()->route('admin.payment.confirmation')->with('success', 'Payment accepted.');
}

public function rejectPayment($id)
{
    $order = TicketOrder::findOrFail($id);
    $order->status = 'rejected';
    $order->save();

    return redirect()->route('admin.payment.confirmation')->with('error', 'Payment rejected.');
}



public function showETicket($id)
{
    $order = TicketOrder::with(['ticket.event'])->findOrFail($id);
    return view('user.ticket_download', compact('order'));
}


public function indext()
{

    $user = Auth::user();
    $contents = TicketOrder::where('user_id', $user->id)// relasi ke tabel users
        ->where('status', 'accepted')
        ->get();

    return view('admin.riwayattransaksi', compact('contents'));
}




}
