<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * @return \Inertia\Response
     */
    public function index(): \Inertia\Response
    {
        return Inertia::render('AccountPage', [
            'films' => [],
        ]);
    }

    /**
     * @param UserStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserStoreRequest $request): \Illuminate\Http\RedirectResponse
    {
        $user = User::create($request->validated());
        if ($user) {
            event(new Registered($user));
            auth()->login($user);

            return redirect()->back()->with('message', 'email-verify-send');
        }

        return redirect()->route('home')->with('message', 'Упс! Что то пошло не так');
    }

    /**
     * @param UserLoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(UserLoginRequest $request): \Illuminate\Http\RedirectResponse
    {
        if (auth()->attempt($request->only('login', 'password')) ||
            auth()->attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->route('user.account');
        }

        return redirect()->back()->withErrors(['user' =>
            ['Неправильное имя пользователя или пароль']]);
    }

    /**
     * @param UserUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserUpdateRequest $request): \Illuminate\Http\RedirectResponse
    {
        $user = auth()->user();
        $user->update([
            'login' => $request->login,
            'email' => $request->email,
            'password' => $request->password_new,
        ]);
        $user->save();

        return redirect()->back();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(): \Illuminate\Http\RedirectResponse
    {
        session()->flush();
        auth()->logout();
        return redirect()->route('home');
    }
}
