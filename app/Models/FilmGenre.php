<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class FilmGenre extends Model
{
    use HasFactory;

    protected $fillable = [
        'film_id',
        'genre_id',
    ];

    public function genre(): HasOne
    {
        return $this->hasOne(Genre::class, 'id', 'genre_id');
    }
}
