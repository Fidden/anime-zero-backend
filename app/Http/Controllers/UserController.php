<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\FilmResource;
use App\Models\Film;
use App\Models\TrackedFilm;
use App\Models\User;
use App\Models\WantToWatchFilm;
use App\Models\WatchedFilm;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return Inertia::render('AccountPage', [
            'films' => [
                'watched' => FilmResource::collection(
                    Film::whereIn('id', WatchedFilm::where('user_id', $user->id)->pluck('film_id'))->paginate(10)),
                'want_to_watch' => FilmResource::collection(
                    Film::whereIn('id', WantToWatchFilm::where('user_id', $user->id)->pluck('film_id'))->paginate(10)),
                'tracked' => FilmResource::collection(
                    Film::whereIn('id', TrackedFilm::where('user_id', $user->id)->pluck('film_id'))->paginate(10)),
            ]
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
            auth('web')->login($user);

            return redirect()->back();
        }

        return redirect()->route('user.account')->with(['email_verify' => 'send']);
    }

    /**
     * @param UserLoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(UserLoginRequest $request): \Illuminate\Http\RedirectResponse
    {
        if (auth()->attempt($request->validated())) {
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
