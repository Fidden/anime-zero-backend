<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailVerifyRequest;
use App\Http\Services\ResponseService;
use App\Notifications\EmailVerificationNotification;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    public function verify(EmailVerifyRequest $request)
    {
        $user = $request->user();
        if ($user->hasVerifiedEmail() || $user->getVerifyCode() !== $request->code) {
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
