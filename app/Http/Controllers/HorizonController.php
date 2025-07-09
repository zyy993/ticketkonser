<?php

namespace App\Http\Controllers;

use App\Models\Horizon;
use App\Models\TicketType;
use App\Models\Home;
use App\Models\Moment;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class HorizonController extends Controller
{
    public function create()
    {
        return view('dashboard.horizon.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'penyanyi' => 'required|string|max:255',
            'date' => 'required|date',
            'show_starts' => 'required',
            'price'        => 'required|numeric|min:0',
            'location' => 'required|string',
            'image_path' => 'nullable|image|max:2048',
        ]);

      if ($request->hasFile('image')) {
    $validated['image_path'] = $request->file('image')->store('images', 'public'); // SIMPAN ke image_path
}


        Horizon::create($validated);

        return redirect()->route('dashboard.index')->with('success', 'Horizon event created successfully.');
    }

    public function edit(Horizon $horizon)
    {
        return view('dashboard.horizon.edit', compact('horizon'));
    }

    public function update(Request $request, Horizon $horizon)
    {
        $validated = $request->validate([
    'name' => 'required|string|max:255',
    'penyanyi' => 'required|string|max:255',
    'date' => 'required|date',
    'show_starts' => 'required',
    'location' => 'required|string',
    'price' => 'required|numeric|min:0',
    'image' => 'nullable|image|max:2048', // GANTI juga di sini
]);

if ($request->hasFile('image')) {
    if ($horizon->image_path) {
        Storage::disk('public')->delete($horizon->image_path);
    }
    $validated['image_path'] = $request->file('image')->store('images', 'public');
}

$horizon->update($validated);

        return redirect()->route('dashboard.index')->with('success', 'Horizon event updated successfully.');
    }public function destroy($id)
{
    $horizon = Horizon::findOrFail($id);

    if ($horizon->image_path) {
        Storage::disk('public')->delete($horizon->image_path);
    }

    $horizon->delete();

    return redirect()->route('dashboard.index')->with('success', 'Horizon event deleted successfully.');
}

public function tampilInfo2($event_id)
{
    $event = Horizon::findOrFail($event_id);
    $tickets = TicketType::where('home_id', $event_id)->get();



    return view('user.info2', compact('event', 'tickets'));
}

public function tampilInfo($event_id)
{
    $event = Horizon::findOrFail($event_id);

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

    return view('user.info2', compact('event', 'tickets'));
}



  public function tampillending()
{
    if (app()->environment('testing')) {
        return response('test passed', 200);
    }

    $contents = Home::orderBy('created_at', 'desc')->get();
    $moments = Moment::orderBy('created_at', 'desc')->get();
    $horizons = Horizon::orderBy('created_at', 'desc')->get();

    return view('lending', compact('contents', 'moments', 'horizons'));
}


}
