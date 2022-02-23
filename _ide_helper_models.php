<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\ContentType
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ContentType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContentType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContentType query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContentType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class ContentType extends \Eloquent {}
}

namespace App\Models{
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
 * @property string $player_link
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\FilmGenre[] $genres
 * @property-read int|null $genres_count
 * @method static \Illuminate\Database\Eloquent\Builder|Film wherePlayerLink($value)
 */
	class Film extends \Eloquent {}
}

namespace App\Models{
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
	class FilmGenre extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Genre
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Genre newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Genre newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Genre query()
 * @method static \Illuminate\Database\Eloquent\Builder|Genre whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Genre whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Genre whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Genre whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Genre extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Status
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Status newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Status newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Status query()
 * @method static \Illuminate\Database\Eloquent\Builder|Status whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Status whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Status whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Status whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Status extends \Eloquent {}
}

namespace App\Models{
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
	class TrackedFilm extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class User extends \Eloquent {}
}

namespace App\Models{
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
	class WantToWatchFilm extends \Eloquent {}
}

namespace App\Models{
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
	class WatchedFilm extends \Eloquent {}
}

