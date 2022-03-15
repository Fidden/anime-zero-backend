<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $genres
 * @property string $statuses
 * @property string $type
 * @property string $years
 * @property string $rating
 * @property string $title
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
            'genres' => 'string',
            'statuses' => 'string',
            'type' => 'string',
            'years' => 'string',
            'rating' => 'string',
            'title' => 'string',
        ];
    }

    public function passedValidation()
    {
        $this->transformToArray('genres');
        $this->transformToArray('statuses');
    }

    public function transformToArray(string $input)
    {
        if (!$this->has($input))
            return;

        $this->merge([$input => str($this->input($input))->contains(',') ?
            str($this->input($input))->explode(',')
            : [$this->input($input)]]);
    }
}
