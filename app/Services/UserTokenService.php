<?php

namespace App\Services;


use App\Models\User;
use Illuminate\Support\Str;

class UserTokenService
{
    public static function generate(User $user = null): string
    {
        $user = $user ?? auth()->user();

        $user->api_token = Str::uuid();
        $user->save();

        return $user->api_token;
    }
}
