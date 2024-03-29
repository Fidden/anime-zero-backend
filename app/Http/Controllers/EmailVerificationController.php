<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailVerifyRequest;
use App\Notifications\EmailVerificationNotification;
use App\Services\ResponseService;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    public function verify(EmailVerifyRequest $request)
    {
        $user = $request->user();
        if ($user->hasVerifiedEmail()) {
            return ResponseService::error('Email already verified.', 200);
        }

        if ($user->getVerifyCode() !== $request->code) {
            return ResponseService::error(
                'Invalid verify code.',
                422
            );
        }

        // удаление использованного кода
        $user->verifyCodes()
            ->where('code', $request->code)
            ->delete();

        $user->markEmailAsVerified();
        event(new Verified($user));

        return ResponseService::success([
            'message' => 'Email verified.',
        ]);
    }

    public function resend(Request $request)
    {
        $user = $request->user();
        $user->notify(new EmailVerificationNotification($user));

        return ResponseService::success([
            'message' => 'Verification email resent.',
        ]);
    }
}
