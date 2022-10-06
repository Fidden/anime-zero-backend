<?php

namespace App\Http\Requests\Film;

use App\Rules\FilmGenre;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property array $genres
 * @property string $statuses
 * @property string $type
 * @property string $years
 * @property string $rating
 * @property string $title
 */
class FilmIndexRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'genres' => ['string', new FilmGenre],
            'statuses' => 'string',
            'type' => 'string',
            'years' => 'string',
            'rating' => 'string|in:asc,desc',
            'title' => 'string|in:asc,desc',
        ];
    }

    private function transformToArray(string $key, string $separator = ',')
    {
        if ($this->has($key)) {
            $this->replace([
                $key => explode($separator, $this->get($key))
            ]);
        }
    }

    protected function passedValidation()
    {
        $this->transformToArray('genres');
        $this->transformToArray('statuses');
        $this->transformToArray('type');
        $this->transformToArray('years', '-');
    }
}
