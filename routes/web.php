<?php

use App\Http\Controllers\{FilmController,
    FilmParserController,
    FilmSearchPageController,
    FilmsPageController,
    HomePageController,
    TrackedFilmController,
    UserAvatarController,
    UserController,
    UserFilmTrackedController,
    UserFilmWantToWatchController,
    UserFilmWatchedController,
    WantToWatchFilmController,
    WatchedFilmController,};
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Password, Route,};
use Inertia\Inertia;

Route::get('/', HomePageController::class)->name('home');
Route::get('/films', FilmsPageController::class)->name('films');
Route::get('/parse', [FilmParserController::class, 'store']);
Route::get('/privacy', fn() => Inertia::render('PrivacyPolicyPage'))->name('privacy');
Route::get('/copy-right', fn() => Inertia::render('CopyrightPage'))->name('copy-right');
Route::get('/about-us', fn() => Inertia::render('AboutUsPage'))->name('about-us');
Route::get('/partners', fn() => Inertia::render('PartnersPage'))->name('partners');

Route::prefix('/film')->group(function () {
    Route::get('/{film}', [FilmController::class, 'show'])->name('film.show');
    Route::get('/search/{query}', FilmSearchPageController::class)->name('film-page.search');
});

Route::prefix('/user')->group(function () {
    Route::post('/', [UserController::class, 'store'])->name('user.store');
    Route::post('/login', [UserController::class, 'login'])->name('user.login');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::prefix('/track-film')->group(function () {
        Route::post('/', [TrackedFilmController::class, 'store'])->name('tracked-film.store');
    });

    Route::prefix('/want-watch-film')->group(function () {
        Route::post('/', [WantToWatchFilmController::class, 'store'])->name('want-to-watch-film.store');
        Route::delete('/{film_id}', [WantToWatchFilmController::class, 'destroy'])->name('want-to-watch-film.destroy');
    });

    Route::prefix('/watched-film')->group(function () {
        Route::post('/', [WatchedFilmController::class, 'store'])->name('watched-film.store');
        Route::delete('/{film_id}', [WatchedFilmController::class, 'destroy'])->name('watched-film.destroy');
    });

    Route::prefix('/user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user.account');
        Route::get('/watched', UserFilmWatchedController::class)->name('user.watched');
        Route::get('/want-to-watch', UserFilmWantToWatchController::class)->name('user.want-to-watch');
        Route::get('/tracked', UserFilmTrackedController::class)->name('user.tracked');


        Route::put('/', [UserController::class, 'update'])->name('user.update');
        Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');
    });

    Route::prefix('/user-avatar')->group(function () {
        Route::put('/', [UserAvatarController::class, 'update'])->name('user-avatar.update');
    });
});

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function () {
    auth()->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');
