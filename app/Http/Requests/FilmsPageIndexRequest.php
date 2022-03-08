<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilmsPageIndexRequest extends FormRequest
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
            'genres' => 'string'
        ];
    }

    public function passedValidation()
    {
        if ($this->has('genres'))
            $this->replace(['genres' => str($this->genres)->explode(',')]);
    }
}
