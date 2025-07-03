<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ticket_id',
        'seat_name',
        'harga_tiket',
        'harga_seat',
        'total_harga',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke TicketType
    public function ticket()
    {
        return $this->belongsTo(TicketType::class, 'ticket_id');
    }

    
}
