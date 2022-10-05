<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $image
 */
class UserAvatarUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'image' => 'required|string',
        ];
    }
}
