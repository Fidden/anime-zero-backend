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

    protected function passedValidation()
    {
        $this->replace([
            'genres' => str($this->genres)->explode(','),
            'statuses' => str($this->statuses)->explode(','),
            'type' => str($this->type)->explode(','),
            'years' => str($this->years)->explode('-'),
        ]);
    }
}
