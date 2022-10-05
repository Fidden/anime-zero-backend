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
        'film_status_id',
        'film_type_id',
        'duration',
    ];

    public function status(): HasOne
    {
        return $this->hasOne(FilmStatus::class, 'id', 'status_id');
    }

    public function genres(): HasMany
    {
        return $this->hasMany(FilmGenre::class, 'film_id', 'id');
    }

    public function contentType(): HasOne
    {
        return $this->hasOne(FilmType::class, 'id', 'content_type_id');
    }

    public function directors(): HasMany
    {
        return $this->hasMany(FilmDirector::class, 'film_id', 'id');
    }

    public function countries(): HasMany
    {
        return $this->hasMany(FilmCountry::class, 'film_id', 'id');
    }

    public function recommended(): HasOne
    {
        return $this->hasOne(FilmRecommended::class, 'film_id', 'id');
    }
}
