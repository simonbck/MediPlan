<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicament extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'dose',
        'unit',
        'pieces_morning',
        'pieces_midday',
        'pieces_evening',
        'pieces_night',
        'user_id',
        'pieces'
    ];
}
