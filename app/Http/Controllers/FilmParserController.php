<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\FilmGenre;
use App\Models\Genre;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class FilmParserController extends Controller
{
    private string $token;

    public function __construct()
    {
        $this->token = 'ac8c072e62855540ec492698e2c1c326';
    }

    public function store()
    {
        ini_set('max_execution_time', 9999999999);

        $request = $this->request("https://kodikapi.com/list?token={$this->token}&types=anime-serial&with_material_data=true");

        while ($request['next_page']) {
            foreach ($request['results'] as $result) {
                if (!$this->isFilmValid($result))
                    continue;

                $film_status = Status::firstOrCreate([
                    'name' => $this->getProperty($result['material_data'], 'all_status', 1)
                ]);

                $film = Film::create([
                    'kodik_id' => $this->getProperty($result, 'id'),
                    'title' => $this->getProperty($result, 'title'),
                    'description' => $this->getProperty($result['material_data'], 'description'),
                    'year' => $this->getProperty($result, 'year'),
                    'poster' => $this->getProperty($result['material_data'], 'poster_url'),
                    'rating' => $this->getRating($result),
                    'minimal_age' => $this->getProperty($result['material_data'], 'minimal_age'),
                    'status_id' => $film_status->id,
                    'content_type_id' => 2,
                ]);

                if (!$this->getProperty($result['material_data'], 'anime_genres'))
                    continue;

                foreach ($result['material_data']['anime_genres'] as $genre) {
                    $genre = Genre::firstOrCreate([
                        'name' => $genre
                    ]);

                    FilmGenre::firstOrCreate([
                        'film_id' => $film->id,
                        'genre_id' => $genre->id,
                    ]);
                }
            }

            $request = $this->request($request['next_page']);
        }
    }

    public function request($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        return json_decode(curl_exec($ch), true);
    }

    public function isFilmValid(array $result): bool
    {
        if (!Arr::exists($result, 'title'))
            return false;

        if (!Arr::exists($result, 'material_data'))
            return false;

        if (!Arr::exists($result['material_data'], 'poster_url'))
            return false;

        if (Film::where('title', $result['title'])->exists() || Film::where('kodik_id', $result['id'])->exists())
            return false;

        return true;
    }

    public function getProperty(array $array, string $property, mixed $default = null)
    {
        return Arr::exists($array, $property) ? $array[$property] : $default;
    }

    public function getRating($result): int|float
    {
        if ($this->getProperty($result, 'kinopoisk_rating'))
            return $result['kinopoisk_rating'];
        else if ($this->getProperty($result, 'imdb_rating'))
            return $result['imdb_rating'];
        else if ($this->getProperty($result, 'shikimori_rating'))
            return $result['shikimori_rating'];
        else if ($this->getProperty($result, 'mydramalist_rating'))
            return $result['mydramalist_rating'];
        return 0;
    }
}
