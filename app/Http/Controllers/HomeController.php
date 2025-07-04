<?php

namespace App\Http\Controllers;

use App\Models\Home;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\TicketType;
use App\Models\TicketOrder;
use App\Models\Horizon;
use App\Models\Moment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function index()
    {
        $events = Home::all();
        $horizons = Horizon::all();
        $moments = Moment::all();

        return view('dashboard.index', compact('events', 'horizons', 'moments'));
    }

    public function create()
    {
        return view('dashboard.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'penyanyi'     => 'required|string|max:255',
            'date'         => 'required|date',
            'gates_open'   => 'nullable|date',
            'show_starts'  => 'nullable|date',
            'expired_at'   => 'nullable|date',
            'deskripsi'    => 'nullable|string',
            'location'     => 'required|string|max:255',
            'price'        => 'required|numeric|min:0',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        Home::create([
            'name'         => $request->name,
            'penyanyi'     => $request->penyanyi,
            'date'         => $request->date,
            'gates_open'   => $request->gates_open,
            'show_starts'  => $request->show_starts,
            'expired_at'   => $request->expired_at,
            'deskripsi'    => $request->deskripsi,
            'location'     => $request->location,
            'price'        => $request->price,
            'image_path'   => $imagePath,
        ]);

        return redirect()->route('dashboard.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit(Home $dashboard)
{
    return view('dashboard.edit', ['event' => $dashboard]);
}

    public function update(Request $request, Home $dashboard)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'penyanyi'     => 'required|string|max:255',
            'date'         => 'required|date',
            'gates_open'   => 'nullable|date',
            'show_starts'  => 'nullable|date',
            'expired_at'   => 'nullable|date',
            'deskripsi'    => 'nullable|string',
            'location'     => 'required|string|max:255',
            'price'        => 'required|numeric|min:0',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $dashboard->fill($request->only([
            'name', 'penyanyi', 'date', 'gates_open', 'show_starts',
            'expired_at', 'deskripsi', 'location', 'price'
        ]));

        if ($request->hasFile('image')) {
            if ($dashboard->image_path && Storage::disk('public')->exists($dashboard->image_path)) {
                Storage::disk('public')->delete($dashboard->image_path);
            }
            $dashboard->image_path = $request->file('image')->store('images', 'public');
        }

        $dashboard->save();

        return redirect()->route('dashboard.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy(Home $dashboard)
    {
        if ($dashboard->image_path && Storage::disk('public')->exists($dashboard->image_path)) {
            Storage::disk('public')->delete($dashboard->image_path);
        }

        $dashboard->delete();

        return redirect()->route('dashboard.index')->with('success', 'Data berhasil dihapus!');
    }

    public function tampilHome()
    {
        $contents = Home::orderBy('created_at', 'desc')->get();
        $moments = Moment::orderBy('created_at', 'desc')->get();
        $horizons = Horizon::orderBy('created_at', 'desc')->get();

        return view('user.home', compact('contents', 'moments', 'horizons'));
    }



    public function tampilriwayat()
    {
        $contents = Home::all();
        return view('user.riwayattransaksi1', compact('contents'));
    }


public function tampilInfo3($event_id)
{
    $event = Home::findOrFail($event_id);

    // Cek apakah sudah ada tiket
    $existingTickets = TicketType::where('home_id', $event_id)->count();

    if ($existingTickets === 0) {
        // Jika belum ada tiket, buat secara otomatis (contoh 4 zona)
        $zones = [
            ['zone' => 'ZONE A', 'harga' => 15000, 'seat_number' => 'A-1'],
            ['zone' => 'ZONE B', 'harga' => 20000, 'seat_number' => 'B-1'],
            ['zone' => 'ZONE C', 'harga' => 18000, 'seat_number' => 'C-1'],
            ['zone' => 'VVIP',    'harga' => 25000, 'seat_number' => 'VVIP-1'],
        ];

        foreach ($zones as $zone) {
            TicketType::create([
                'home_id'      => $event_id,
                'jenis_tiket'  => 'Reguler',
                'zone'         => $zone['zone'],
                'harga'        => $zone['harga'],
                'seat_number'  => $zone['seat_number'],
                'status'       => 'available',
            ]);
        }
    }

    // Ambil tiket setelah dijamin ada
    $tickets = TicketType::where('home_id', $event_id)->get();

    return view('user.info3', compact('event', 'tickets'));
}




  public function pilihTempat($event_id)
{
    $event = Home::findOrFail($event_id);

    // 🔍 Cek apakah tiket sudah ada
    $ticketCount = TicketType::where('home_id', $event_id)->count();

    // 🛠️ Jika belum, buat otomatis
    if ($ticketCount === 0) {
        $defaultTickets = [
            ['jenis_tiket' => 'Reguler', 'zone' => 'ZONE A', 'harga' => 15000, 'seat_number' => 'A-1'],
            ['jenis_tiket' => 'Reguler', 'zone' => 'ZONE B', 'harga' => 20000, 'seat_number' => 'B-1'],
            ['jenis_tiket' => 'Reguler', 'zone' => 'ZONE C', 'harga' => 18000, 'seat_number' => 'C-1'],
            ['jenis_tiket' => 'Reguler', 'zone' => 'ZONE D', 'harga' => 12000, 'seat_number' => 'D-1'],
            ['jenis_tiket' => 'VIP',     'zone' => 'VVIP',   'harga' => 25000, 'seat_number' => 'VVIP-1'],
        ];

        foreach ($defaultTickets as $data) {
            TicketType::create([
                'home_id'     => $event_id,
                'jenis_tiket' => $data['jenis_tiket'],
                'zone'        => $data['zone'],
                'harga'       => $data['harga'],
                'seat_number' => $data['seat_number'],
                'status'      => 'available',
            ]);
        }
    }

    // ✅ Ambil ulang data ticket setelah create (jika ada)
    $tickets = TicketType::where('home_id', $event_id)->get();

    return view('user.pilihtempat', compact('event', 'tickets'));
}

    public function simpanPilihTempat(Request $request)
    {
        $request->validate([
            'ticket_id'  => 'required|exists:ticket_types,id',
            'seat_name'  => 'required|string|max:255',
            'harga_seat' => 'required|numeric|min:0',
        ]);

        $ticket = TicketType::with('event')->findOrFail($request->ticket_id);
        $hargaTiket = $ticket->event->price;
        $total = $hargaTiket + $request->harga_seat;

        TicketOrder::create([
            'user_id'      => auth()->id() ?? 1,
            'ticket_id'    => $request->ticket_id,
            'seat_name'    => $request->seat_name,
            'harga_tiket'  => $hargaTiket,
            'harga_seat'   => $request->harga_seat,
            'total_harga'  => $total,
        ]);

        return redirect()->route('user.eticket')->with('success', 'Tempat berhasil dipilih!');
    }

    public function tampilETicket()
    {
        $order = TicketOrder::where('user_id', auth()->id())
            ->with(['ticket.event'])
            ->latest()
            ->first();

        $tax = 2000;
        $subtotal = $order->harga_tiket + $order->harga_seat;
        $total = $subtotal + $tax;

        return view('user.eticket', compact('order', 'subtotal', 'tax', 'total'));
    }

    public function Jumlahtampil()
    {
        $totalEvents = Home::count();
        $totalUsers = User::count();
        $ticketsSold = TicketOrder::count();
        $latestOrders = TicketOrder::with(['ticket.event', 'user'])->latest()->take(5)->get();
        $totalRevenue = TicketOrder::sum('total_harga');

        return view('promotor.dashboard', compact('totalEvents', 'totalUsers', 'latestOrders', 'ticketsSold', 'totalRevenue'));
    }

    public function tampilShoppingBasket()
{
    $orders = TicketOrder::where('user_id', auth()->id())
                 // kalau pakai status
                ->with(['ticket.event'])
                ->latest()
                ->get();

    return view('user.shoppingbasket', compact('orders'));
}



    public function mysales()
    {
        $data = DB::table('ticket_orders')
            ->join('ticket_types', 'ticket_orders.ticket_id', '=', 'ticket_types.id')
            ->join('home_page_contents', 'ticket_types.home_id', '=', 'home_page_contents.id')
            ->select('home_page_contents.name as event_name', DB::raw('COUNT(*) as total'))
            ->groupBy('home_page_contents.name')
            ->get();

        $weeklySales = [];
        $events = Home::all();

        foreach ($events as $event) {
            $startDate = Carbon::now()->subWeeks(3)->startOfWeek();
            for ($i = 0; $i < 4; $i++) {
                $from = $startDate->copy()->addWeeks($i);
                $to = $from->copy()->endOfWeek();

                $count = DB::table('ticket_orders')
                    ->join('ticket_types', 'ticket_orders.ticket_id', '=', 'ticket_types.id')
                    ->where('ticket_types.home_id', $event->id)
                    ->whereBetween('ticket_orders.created_at', [$from, $to])
                    ->count();

                $weeklySales[$event->name][] = [
                    'label' => 'Minggu ' . ($i + 1),
                    'jumlah' => $count,
                ];
            }
        }

        return view('promotor.mysales', compact('data', 'weeklySales'));
    }


public function dashboard()
{
    // 1. Ambil konser yang status aktif
   // Ambil ID konser yang aktif
$konserAktifIds = Home::where('status', 'aktif')->pluck('id');

// Ambil ticket_id dari ticket_types berdasarkan konser aktif
$ticketIds = TicketType::whereIn('home_id', $konserAktifIds)->pluck('id');

// Hitung jumlah tiket terjual dari ticket_orders yang memiliki ticket aktif
$tiketTerjual = TicketOrder::whereIn('ticket_id', $ticketIds)->count();

// Hitung total pendapatan
$totalPendapatan = TicketOrder::whereIn('ticket_id', $ticketIds)->sum('total_harga');

// Hitung jumlah konser aktif
$jumlahKonserAktif = $konserAktifIds->count();

 $penjualanPerHari = TicketOrder::selectRaw('DATE(created_at) as tanggal, COUNT(*) as total')
        ->groupBy('tanggal')
        ->orderBy('tanggal', 'asc')
        ->limit(10)
        ->get();

    // Siapkan koordinat grafik
    $startX = 100;
    $stepX = 110;
    $yBase = 390;
    $scale = 1; // 1 tiket = 1px naik

    $dataPoints = [];
    foreach ($penjualanPerHari as $index => $data) {
        $x = $startX + $index * $stepX;
        $y = $yBase - ($data->total * $scale); // Semakin banyak tiket, semakin naik

        $dataPoints[] = [
            'tanggal' => $data->tanggal,
            'x' => $x,
            'y' => max($y, 40), // jangan lebih dari batas atas (opsional)
            'total' => $data->total
        ];
    }


return view('admin.haladmin', compact('jumlahKonserAktif', 'tiketTerjual', 'totalPendapatan', 'dataPoints'));

}

public function downloadTicket($order_id)
{
    $order = TicketOrder::with(['ticket', 'ticket.event'])->findOrFail($order_id);

    if ($order->status !== 'accepted') {
        return redirect()->back()->with('error', 'Ticket belum dapat diunduh karena belum diterima.');
    }

    return view('user.ticket_download', compact('order'));
}


public function showShoppingBasket()
{
    // Ambil semua pesanan berdasarkan user yang sedang login
    $orders = TicketOrder::with(['ticket', 'ticket.event']) // pastikan relasi ini benar
                ->where('user_id', Auth::id())
                ->latest()
                ->get();

    return view('user.shoppingbasket', compact('orders'));
}





}
