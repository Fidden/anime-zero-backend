<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\FilmComent
 *
 * @property int $id
 * @property int $user_id
 * @property int $film_id
 * @property string $comment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|FilmComent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FilmComent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FilmComent query()
 * @method static \Illuminate\Database\Eloquent\Builder|FilmComent whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FilmComent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FilmComent whereFilmId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FilmComent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FilmComent whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FilmComent whereUserId($value)
 * @mixin \Eloquent
 */
class FilmComent extends Model
{
    use HasFactory;
}
