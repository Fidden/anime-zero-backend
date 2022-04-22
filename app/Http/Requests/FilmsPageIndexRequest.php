<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property array|null $genres
 * @property array|null $statuses
 * @property string|null $type
 * @property string|null $years
 * @property string|null $rating
 * @property string|null $title
 */
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
            'genres' => 'array',
            'statuses' => 'array',
            'type' => 'string',
            'years' => 'string',
            'rating' => 'string',
            'title' => 'string',
        ];
    }
}
