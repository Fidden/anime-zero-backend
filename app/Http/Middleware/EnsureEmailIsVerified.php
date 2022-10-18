<?php

namespace App\Http\Middleware;

use App\Services\ResponseService;
use Closure;

class EnsureEmailIsVerified
{
    public function handle($request, Closure $next, $redirectToRoute = null)
    {
        $user = auth()->user();
        if ($user && !$user->hasVerifiedEmail()) {
            return ResponseService::error(
                'Your email address is not verified.',
                403
            );
        }

        return $next($request);
    }
}
