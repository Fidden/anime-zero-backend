<?php

namespace App\Http\Controllers;

use App\Http\Requests\{User\UserLoginRequest, User\UserStoreRequest, User\UserUpdateRequest, UserAvatarUpdateRequest};
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Notifications\EmailVerificationNotification;
use App\Services\ResponseService;
use App\Services\UserTokenService;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function info()
    {
        return ResponseService::success(
            UserResource::make(auth()->user())
        );
    }

    public function store(UserStoreRequest $request)
    {
        $user = User::create($request->validated());
        if ($user) {
            $user->notify(new EmailVerificationNotification($user));

            return ResponseService::success([
                'token' => UserTokenService::generate($user),
            ]);
        }

        return ResponseService::error('Something went wrong.', 500);
    }

    public function login(UserLoginRequest $request)
    {
        if (auth()->attempt($request->validated())) {
            if (!auth()->user()->hasVerifiedEmail()) {
                return ResponseService::error('Please verify your email.', 401);
            }

            return ResponseService::success([
                'token' => UserTokenService::generate(),
            ]);
        }

        return ResponseService::error('Failed to login.', 401, [
            'user' => [
                'login' => 'Incorrect login or password.',
            ],
        ]);
    }

    public function logout()
    {
        auth()->user()->forceFill([
            'api_token' => null,
        ])->save();

        return response(null, 200);
    }

    public function avatar(UserAvatarUpdateRequest $request)
    {
        $user = auth()->user();
        {
            $image = $request->image;
            $image = preg_replace('/data:image\/(.*?);base64,/', '', $image);
            $image = str_replace(' ', '+', $image);

            $file_name = "avatars/{$user->login}_{$user->id}.png";
            Storage::disk('public')->put($file_name, base64_decode($image));
            $user->avatar = Storage::url($file_name);
        }
        $user->save();

        return ResponseService::noContent();
    }

    public function requestCode()
    {
        $user = auth()->user();
        $user->notify(new EmailVerificationNotification($user));

        return ResponseService::noContent();
    }

    public function update(UserUpdateRequest $request)
    {
        $user = auth()->user();
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

        $user->update($request->validated());

        return ResponseService::noContent();
    }
}
