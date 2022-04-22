<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecommendedFilm extends Model
{
    use HasFactory;

    protected $fillable = [
        'film_id',
    ];
}
