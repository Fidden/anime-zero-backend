<?php

namespace App\Models;


use App\Http\Filters\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Scout\Attributes\SearchUsingFullText;
use Laravel\Scout\Attributes\SearchUsingPrefix;
use Laravel\Scout\Searchable;

class Film extends Model
{
    use HasFactory, Filterable, Searchable;

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

    #[SearchUsingFullText(['title', 'title_orig'])]
    public function toSearchableArray(): array
    {
        return [
            'title' => $this->title,
            'title_orig' => $this->title_orig,
        ];
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
