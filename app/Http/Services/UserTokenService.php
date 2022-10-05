<?php

namespace App\Http\Services;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

class UserTokenService
{
    public static function generate(Authenticatable $user = null): string
    {
        $user = $user ?? auth()->user();

        $user->api_token = Str::uuid();
        $user->save();

        return $user->api_token;
    }
}
