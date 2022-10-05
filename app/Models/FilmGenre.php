<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilmGenre extends Model
{
    use HasFactory;

    protected $fillable = [
        'film_id',
        'genre_id',
    ];

    public function genre(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Genre::class, 'id', 'genre_id');
    }
}
