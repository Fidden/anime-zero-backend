<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Film
 *
 * @property int $id
 * @property string $kodik_id
 * @property string $title
 * @property string|null $description
 * @property string|null $year
 * @property string $poster
 * @property float $rating
 * @property int|null $minimal_age
 * @property int $status_id
 * @property int $content_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Film newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Film newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Film query()
 * @method static \Illuminate\Database\Eloquent\Builder|Film whereContentTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Film whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Film whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Film whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Film whereKodikId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Film whereMinimalAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Film wherePoster($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Film whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Film whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Film whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Film whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Film whereYear($value)
 * @mixin \Eloquent
 * @property string|null $kinopoisk_id
 * @property string|null $worldart_id
 * @property string|null $imdb_id
 * @property string $player_link
 * @property string $title_orig
 * @property int|null $duration
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\FilmGenre[] $genres
 * @property-read int|null $genres_count
 * @method static \Illuminate\Database\Eloquent\Builder|Film whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Film whereImdbId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Film whereKinopoiskId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Film wherePlayerLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Film whereTitleOrig($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Film whereWorldartId($value)
 */
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

    public function genres(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(FilmGenre::class, 'film_id', 'id');
    }
}
