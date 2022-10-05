<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrackedFilmStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id|integer',
            'film_id' => 'required|exists:films,id|integer',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(['user_id' => $this->user()->id]);
    }
}
