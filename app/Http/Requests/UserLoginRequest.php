<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $login
 * @property string $password
 */
class UserLoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'login' => 'required|string|max:32',
            'password' => 'required|string|max:32',
        ];
    }
}
