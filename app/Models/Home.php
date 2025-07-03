<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    use HasFactory;

    protected $table = 'home_page_contents';

    protected $fillable = [
        'name',
        'image_path',
        'penyanyi',
        'date',
        'gates_open',
        'show_starts',
        'deskripsi',
        'expired_at',
        'location',
        'price',
    ];

    protected $casts = [
        'date' => 'datetime',
        'gates_open' => 'datetime',
        'show_starts' => 'datetime',
        'expired_at' => 'datetime',
    ];

    public function tickets()
{
    return $this->hasMany(TicketType::class, 'home_id');
}

}
