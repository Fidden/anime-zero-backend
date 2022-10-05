<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UserStoreRequest
 * @property string $login
 * @property string $email
 * @property string $password
 * @property string $password_repeat
 * @property bool $remember
 * @package App\Http\Requests
 */
class UserStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'login' => 'required|string|unique:users,login|max:32',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|max:32',
            'password_repeat' => 'required|string|same:password',
        ];
    }
}
