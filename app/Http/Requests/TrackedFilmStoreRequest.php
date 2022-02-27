<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrackedFilmStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
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
