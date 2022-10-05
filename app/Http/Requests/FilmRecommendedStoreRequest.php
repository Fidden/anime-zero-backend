<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class FilmRecommendedStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('admin');
    }

    public function rules(): array
    {
        return [
            'film_id' => 'required|integer|exists:films,id|unique:recommended_films,film_id',
            'poster' => 'required|string',
            'tag_id' => 'required|integer|exists:tags,id',
        ];
    }
}
