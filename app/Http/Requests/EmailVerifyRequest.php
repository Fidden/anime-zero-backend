<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmailVerifyRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'code' => 'required|string|min:6|max:6',
        ];
    }
}
