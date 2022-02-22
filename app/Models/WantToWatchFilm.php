<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\WantToWatchFilm
 *
 * @property int $id
 * @property int $user_id
 * @property int $film_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|WantToWatchFilm newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WantToWatchFilm newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WantToWatchFilm query()
 * @method static \Illuminate\Database\Eloquent\Builder|WantToWatchFilm whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WantToWatchFilm whereFilmId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WantToWatchFilm whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WantToWatchFilm whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WantToWatchFilm whereUserId($value)
 * @mixin \Eloquent
 */
class WantToWatchFilm extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'film_id',
    ];
}
