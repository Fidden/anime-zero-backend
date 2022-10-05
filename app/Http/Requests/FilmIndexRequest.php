<?php

namespace App\Http\Requests;

use App\Rules\FilmGenre;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $genres
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
            'rating' => 'string',
            'title' => 'string',
        ];
    }
}
