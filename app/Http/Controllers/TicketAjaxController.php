<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TicketType;
use App\Models\Home;

class TicketAjaxController extends Controller
{
    public function getTicketIdByZone(Request $request)
    {
        $homeId = $request->query('home_id');
        $zone   = strtoupper($request->query('zone'));

        $ticket = TicketType::where('home_id', $homeId)
                            ->where('zone', $zone)
                            ->first();

        if ($ticket) {
            return response()->json(['ticket_id' => $ticket->id]);
        } else {
            return response()->json(['ticket_id' => null], 404);
        }
    }

    public function pilihTempat($event_id)
{


    $event = Home::findOrFail($event_id); // pastikan ini ada
    $tickets = TicketType::where('home_id', $event_id)->get();
     //dd([
       // 'event' => $event,
       // 'tickets' => $tickets
    //]);


    return view('user.pilihtempat', compact('event', 'tickets'));
}

}
