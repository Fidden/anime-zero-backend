<?php

namespace App\Http\Requests\FilmTracked;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int $film_id
 */
class FilmTrackedStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'film_id' => 'required|integer|exists:films,id',
        ];
    }
}
