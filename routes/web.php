<?php

use App\Http\Controllers\FilmController;
use App\Http\Controllers\FilmParserController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\TrackedFilmController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WantToWatchFilmController;
use App\Http\Controllers\WatchedFilmController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', HomePageController::class)->name('home');
Route::get('/parse', [FilmParserController::class, 'store']);

Route::prefix('/film')->group(function () {
    Route::get('/{film}', [FilmController::class, 'show'])->name('film.show');
});

Route::prefix('/user')->group(function () {
    Route::post('/', [UserController::class, 'store'])->name('user.store');
    Route::post('/login', [UserController::class, 'login'])->name('user.login');
});

Route::middleware('auth')->group(function () {

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
        Route::put('/', [UserController::class, 'update'])->name('user.update');
        Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');
    });
});
