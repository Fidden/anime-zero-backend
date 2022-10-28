<?php

namespace App\Jobs;

use App\Models\Country;
use App\Models\Director;
use App\Models\Film;
use App\Models\FilmGenre;
use App\Models\Genre;
use App\Models\Status;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;

class ParseJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $kodik_token, $cdn_token;
    private int $type;

    public function __construct(int $type = 0)
    {
        $this->type = $type;
        $this->kodik_token = 'ac8c072e62855540ec492698e2c1c326';
        $this->cdn_token = 'uKsTcuM4vCJBMVYb7ysJwnfyhmtBJ9p0';
    }

    public function handle(): void
    {
        $request = $this->type == 0 ?
            $this->request("https://videocdn.tv/api/anime-tv-series?api_token={$this->cdn_token}")
            : $this->request("https://videocdn.tv/api/animes?api_token={$this->cdn_token}");

        while ($request['next_page_url']) {
            foreach ($request['data'] as $result) {
                $kodik_data = $this->getKodikData($result);

                if (!$this->isKodikDataValid($kodik_data) || !$this->isFilmValid($result))
                    continue;

                $filmStatus = $this->storeStatus($this->getFilmStatus($kodik_data));

                $film = Film::firstOrCreate([
                    'imdb_id' => $this->getProperty($result, 'imdb_id'),
                    'kinopoisk_id' => $this->getProperty($result, 'kinopoisk_id'),
                    'worldart_id' => $this->getProperty($result, 'worldart_id'),
                    'player_link' => $this->getProperty($result, 'iframe_src'),
                    'title' => $this->getProperty($result, 'ru_title'),
                    'title_orig' => $this->getProperty($result, 'orig_title'),
                    'duration' => $this->getProperty($kodik_data['material_data'], 'duration'),
                    'description' => $this->getProperty($kodik_data['material_data'], 'description'),
                    'year' => $this->getProperty($kodik_data, 'year'),
                    'poster' => $this->getProperty($kodik_data['material_data'], 'poster_url'),
                    'rating' => $this->getRating($kodik_data),
                    'minimal_age' => $this->getProperty($kodik_data['material_data'], 'minimal_age'),
                    'status_id' => $filmStatus->id,
                    'type_id' => $this->type == 0 ? 2 : 1,
                ]);

                $this->storeCountries($film, $this->getProperty($kodik_data['material_data'], 'countries'));
                $this->storeDirectors($film, $this->getProperty($kodik_data['material_data'], 'directors'));
                $this->storeGenres($film, $this->getProperty($kodik_data['material_data'], 'anime_genres'));
            }

            $request = $this->request($request['next_page_url']);
        }
    }

    public function storeCountries(Film $film, array|null $countries)
    {
        if (!$countries || !count($countries))
            return;

        foreach ($countries as $country) {
            $film->countries()->create([
                'country_id' => Country::firstOrCreate([
                    'name' => $country,
                ])->id,
            ]);
        }
    }

    public function storeDirectors(Film $film, array|null $directors)
    {
        if (!$directors || !count($directors))
            return;

        foreach ($directors as $director) {
            $film->directors()->create([
                'director_id' => Director::firstOrCreate([
                    'name' => $director
                ])->id,
            ]);
        }
    }

    public function storeGenres(Film $film, array|null $genres)
    {
        if (!$genres || !count($genres))
            return;

        foreach ($genres as $genre) {
            FilmGenre::firstOrCreate([
                'film_id' => $film->id,
                'genre_id' => Genre::firstOrCreate([
                    'name' => $genre,
                    'value' => $this->toTranslate($genre),
                ])->id,
            ]);
        }
    }

    public function storeStatus(array $status): ?Status
    {
        if (!$status || !count($status))
            return null;


        return Status::firstOrCreate([
            'name' => $status[0],
            'value' => $status[1],
        ]);
    }

    public function request($url)
    {
        return json_decode(file_get_contents($url), true);
    }

    public function toTranslate($string): array|string
    {
        $rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я');
        $lat = array('A', 'B', 'V', 'G', 'D', 'E', 'E', 'Gh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'C', 'Ch', 'Sh', 'Sch', 'Y', 'Y', 'Y', 'E', 'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', 'y', 'y', 'y', 'e', 'yu', 'ya');
        return str_replace($rus, $lat, $string);
    }

    public function getKodikData(array $result): array|null
    {
        try {
            if (Arr::exists($result, 'kinopoisk_id'))
                $kinopoisk_data = $this->request("https://kodikapi.com/search?token={$this->kodik_token}&with_material_data=true&kinopoisk_id={$result['kinopoisk_id']}");

            if (Arr::exists($result, 'imdb_id'))
                $imdb_data = $this->request("https://kodikapi.com/search?token={$this->kodik_token}&with_material_data=true&imdb_id={$result['imdb_id']}");

            if (Arr::exists($result, 'worldart_id'))
                $worldart_data = $this->request("https://kodikapi.com/search?token={$this->kodik_token}&with_material_data=true&worldart_animation_id={$result['worldart_id']}");

            if ($kinopoisk_data['total'] > 0)
                return $kinopoisk_data['results'][0];
            else if ($imdb_data['total'] > 0)
                return $imdb_data['results'][0];
            else if ($worldart_data['total'] > 0)
                return $worldart_data['results'][0];
        } catch (\Exception $e) {
            return [];
        }

        return [];
    }

    public function isKodikDataValid(array $result): bool
    {
        if (!Arr::exists($result, 'title'))
            return false;

        if (!Arr::exists($result, 'material_data'))
            return false;

        if (!Arr::exists($result['material_data'], 'poster_url'))
            return false;

        return true;
    }

    public function isFilmValid(array $result): bool
    {
        if (Film::where('title', $result['ru_title'])->exists())
            return false;

        if (Film::where('title_orig', $result['orig_title'])->exists())
            return false;

        if (Arr::exists($result, 'kinopoisk_id') &&
            Film::whereNotNull('kinopoisk_id')->where('kinopoisk_id', $result['kinopoisk_id'])->exists())
            return false;

        if (Arr::exists($result, 'worldart_id') &&
            Film::whereNotNull('worldart_id')->where('worldart_id', $result['worldart_id'])->exists())
            return false;

        if (Arr::exists($result, 'imdb_id') &&
            Film::whereNotNull('imdb_id')->where('imdb_id', $result['imdb_id'])->exists())
            return false;

        return true;
    }

    public function getFilmStatus(array $kodik_data): array
    {
        $status = $this->getProperty($kodik_data['material_data'], 'all_status');
        return match ($status) {
            'ongoing' => ['Онгоинг', 'ongoing'],
            'released' => ['Вышел', 'released'],
            'anons' => ['Анонсирован', 'announced'],
            default => ['Без статуса', 'unknown'],
        };
    }

    public function getProperty(array $array, string $property, mixed $default = null)
    {
        return Arr::exists($array, $property) ? $array[$property] : $default;
    }

    public function getRating($result): int|float
    {
        $ratings = [
            $this->getProperty($result['material_data'], 'mydramalist_rating', 0),
            $this->getProperty($result['material_data'], 'kinopoisk_rating', 0),
            $this->getProperty($result['material_data'], 'imdb_rating', 0),
            $this->getProperty($result['material_data'], 'shikimori_rating', 0)
        ];

        $non_zero = array_filter($ratings, function ($item) use ($ratings) {
            return $item > 0;
        });

        if (!$non_zero)
            return 0;

        return number_format((float)(array_sum($non_zero) / count($non_zero)), 1);
    }
}
