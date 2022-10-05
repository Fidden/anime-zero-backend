<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $login
 * @property string $email
 * @property string $password
 * @property string $password_repeat
 */
class UserStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'login' => 'required|string|unique:users,login|max:32|min:4',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'password_repeat' => 'required|string|same:password',
        ];
    }
}
