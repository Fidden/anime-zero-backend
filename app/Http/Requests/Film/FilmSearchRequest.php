<?php

namespace App\Http\Requests\Film;

use Illuminate\Foundation\Http\FormRequest;

class FilmSearchRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'query' => 'required|string',
        ];
    }
}
