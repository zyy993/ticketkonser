<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horizon extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'penyanyi', 'date', 'gates_open', 'show_starts',
        'expired_at', 'deskripsi', 'location', 'price', 'image_path',
    ];
}

