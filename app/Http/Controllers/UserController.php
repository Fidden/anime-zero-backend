<?php

namespace App\Http\Controllers;

use App\Http\Requests\{UserLoginRequest, UserStoreRequest, UserUpdateRequest};
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

        return redirect()->route('home')->with('notification', 'Упс! Что то пошло не так');
    }

    /**
     * @param UserLoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(UserLoginRequest $request): \Illuminate\Http\RedirectResponse
    {
        //todo: fix this
        if (auth()->attempt(['login' => $request->login, 'password' => $request->password])
            || auth()->attempt(['email' => $request->login, 'password' => $request->password])) {
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

        if (\Hash::make($request->password_old) != $user->password)
            return redirect()->withErrors(['password' => 'Неверный старый пароль.']);

        $user->update([
            'login' => $request->login,
            'email' => $request->email,
            'password' => $request->password_new,
        ]);

        return redirect()->back();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(): \Illuminate\Http\RedirectResponse
    {
        auth()->logout();
        return redirect()->route('home');
    }
}
