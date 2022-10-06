<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
        'type_id',
        'duration',
    ];

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function genres(): HasMany
    {
        return $this->hasMany(FilmGenre::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    public function directors(): HasMany
    {
        return $this->hasMany(FilmDirector::class);
    }

    public function countries(): HasMany
    {
        return $this->hasMany(FilmCountry::class);
    }

    public function recommended(): HasOne
    {
        return $this->hasOne(FilmRecommended::class);
    }
}
