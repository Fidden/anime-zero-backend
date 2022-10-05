<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int $film_id
 */
class FilmWatchedStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'film_id' => 'required|integer|exists:films,id',
        ];
    }
}
