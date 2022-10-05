<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'login' => ['required', 'string', 'max:32', Rule::unique('users', 'login')->ignore($this->user())],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->user())],
            'password_old' => 'required|string|max:32',
            'password_new' => 'required|string|max:32',
            'password_new_repeat' => 'required|string|same:password_new',
        ];
    }
}
