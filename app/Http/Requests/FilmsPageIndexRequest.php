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
