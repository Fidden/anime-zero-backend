<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class FilmTracked extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'film_id'
    ];

    public function film(): HasOne
    {
        return $this->hasOne(Film::class, 'id', 'film_id');
    }
}
