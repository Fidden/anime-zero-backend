<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\TrackedFilm
 *
 * @property int $id
 * @property int $user_id
 * @property int $film_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|TrackedFilm newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TrackedFilm newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TrackedFilm query()
 * @method static \Illuminate\Database\Eloquent\Builder|TrackedFilm whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrackedFilm whereFilmId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrackedFilm whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrackedFilm whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrackedFilm whereUserId($value)
 * @mixin \Eloquent
 */
class TrackedFilm extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'film_id',
    ];

    public function film(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Film::class, 'id', 'film_id');
    }
}
