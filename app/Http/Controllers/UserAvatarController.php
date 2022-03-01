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
        {
            $image = $request->image;
            $image = preg_replace('/data:image\/(.*?);base64,/', '', $image);
            $image = str_replace(' ', '+', $image);

            $file_name = "avatars/{$user->login}_{$user->id}.webp";
            Storage::disk('public')->put($file_name, base64_decode($image));
            $user->avatar = Storage::url($file_name);
        }
        $user->save();

        return redirect()->back();
    }
}
