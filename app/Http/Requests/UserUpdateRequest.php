<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
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
