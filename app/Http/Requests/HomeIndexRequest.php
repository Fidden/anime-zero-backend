<?php

namespace App\Http\Requests;

use App\Rules\StringInArray;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $blocks
 */
class HomeIndexRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'blocks' => ['required', 'string', new StringInArray([
                'preview', 'newest', 'ongoing', 'recommended'
            ])],
        ];
    }
}
