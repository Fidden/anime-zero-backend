<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        return Inertia::render('AccountPage', [

        ]);
    }


    /**
     * @param UserStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserStoreRequest $request): \Illuminate\Http\RedirectResponse
    {
        $user = User::create($request->validated());
        auth()->login($user, $request->remember);

        return redirect()->back();
    }

    /**
     * @param UserLoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(UserLoginRequest $request): \Illuminate\Http\RedirectResponse
    {
        if (auth()->attempt($request->validated())) {
            $request->session()->regenerate();
            return redirect()->back();
        }

        return redirect()->back()->withErrors(['user' =>
            ['Неправильное имя пользователя или пароль']]);
    }
}
