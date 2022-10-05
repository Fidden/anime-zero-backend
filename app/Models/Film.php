<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Film extends Model
{
    use HasFactory;

    protected $fillable = [
        'kinopoisk_id',
        'worldart_id',
        'imdb_id',
        'player_link',
        'title',
        'title_orig',
        'description',
        'year',
        'poster',
        'rating',
        'minimal_age',
        'status_id',
        'content_type_id',
        'duration',
    ];

    public function genres(): HasMany
    {
        return $this->hasMany(FilmGenre::class, 'film_id', 'id');
    }

    public function recommended(): HasOne
    {
        return $this->hasOne(FilmRecommended::class, 'film_id', 'id');
    }
}
