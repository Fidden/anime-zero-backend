<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WantToWatchFilmStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => 'required|integer|exists:users,id',
            'film_id' => 'required|integer|exists:films,id',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(['user_id' => $this->user()->id]);
    }
}
