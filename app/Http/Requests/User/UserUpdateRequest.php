<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $login
 * @property string $email
 * @property string $password
 * @property string $password_repeat
 * @property int $code
 */
class UserUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'login' => 'string|unique:users,login|max:32|min:4',
            'email' => 'email|unique:users,email',
            'password' => 'string|min:8',
            'password_repeat' => 'string|same:password',
            'code' => 'required|string'
        ];
    }
}
