<?php

namespace App\Services;

class ResponseService
{
    public static function error(string $message, int $code, mixed $payload = []): \Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        return response([
            'error' => [
                'code' => $code,
                'message' => $message,
                'payload' => $payload,
            ]
        ], $code);
    }

    public static function success(mixed $data, int $code = 200): \Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        return response([
            'data' => $data,
        ], $code);
    }

    public static function created(): \Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        return response(null, 201);
    }

    public static function noContent(): \Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        return response(null, 204);
    }
}
