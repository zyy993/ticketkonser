<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketType extends Model
{
    use HasFactory;

   protected $fillable = [
    'home_id',
    'jenis_tiket',
    'zone', // ✅ tambah ini
    'harga',
     'quantity',
    'seat_number',
    'status',
];


    public function event()
    {
        return $this->belongsTo(Home::class, 'home_id');
    }


}
