<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\WatchedFilm
 *
 * @property int $id
 * @property int $user_id
 * @property int $film_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|WatchedFilm newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WatchedFilm newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WatchedFilm query()
 * @method static \Illuminate\Database\Eloquent\Builder|WatchedFilm whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WatchedFilm whereFilmId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WatchedFilm whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WatchedFilm whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WatchedFilm whereUserId($value)
 * @mixin \Eloquent
 */
class WatchedFilm extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'film_id',
    ];

    public function film()
    {
        return $this->hasOne(Film::class, 'id', 'film_id');
    }
}
