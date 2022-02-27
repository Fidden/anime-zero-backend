<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAvatarUpdateRequest;
use Illuminate\Support\Facades\Storage;

class UserAvatarController extends Controller
{
    /**
     * @param UserAvatarUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserAvatarUpdateRequest $request): \Illuminate\Http\RedirectResponse
    {
        $user = auth()->user();
        $user->avatar = Storage::disk('local')->put("avatar/{$user->login}_{$user->id}.png",
            base64_decode($request->image));
        $user->save();

        return redirect()->back();
    }
}
