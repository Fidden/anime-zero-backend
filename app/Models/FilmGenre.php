<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\FilmGenre
 *
 * @property int $id
 * @property int $film_id
 * @property int $genre_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|FilmGenre newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FilmGenre newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FilmGenre query()
 * @method static \Illuminate\Database\Eloquent\Builder|FilmGenre whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FilmGenre whereFilmId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FilmGenre whereGenreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FilmGenre whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FilmGenre whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Genre|null $genre
 */
class FilmGenre extends Model
{
    use HasFactory;

    protected $fillable = [
        'film_id',
        'genre_id',
    ];

    public function genre()
    {
        return $this->hasOne(Genre::class, 'id', 'genre_id');
    }
}
