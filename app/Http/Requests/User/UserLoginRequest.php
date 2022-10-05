<?php

namespace App\Http\Requests\User;

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
            'login' => 'required|string|max:32|min:4',
            'password' => 'required|string|min:4',
        ];
    }
}
