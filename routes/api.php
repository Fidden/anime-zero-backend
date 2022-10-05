<?php

use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\FilmGenreController;
use App\Http\Controllers\FilmRecommendedController;
use App\Http\Controllers\FilmStatusController;
use App\Http\Controllers\FilmTrackedController;
use App\Http\Controllers\FilmTypeController;
use App\Http\Controllers\FilmWantWatchController;
use App\Http\Controllers\FilmWatchedController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Models\UserVerifyCode;

Route::prefix('/user')->group(function () {
    Route::post('/register', [UserController::class, 'store']);
    Route::post('/login', [UserController::class, 'login']);

    Route::middleware(['auth:api', 'verified'])->group(function () {
        Route::get('/logout', [UserController::class, 'logout']);
        Route::get('/info', [UserController::class, 'info']);
        Route::post('/avatar', [UserController::class, 'avatar']);
        Route::post('/update', [UserController::class, 'update']);
        Route::post('/request-code', [UserController::class, 'requestCode']);
    });
});


Route::prefix('/homepage')->group(function () {
    Route::get('/', [HomeController::class, 'index']);
});

Route::prefix('/film')->group(function () {
    Route::prefix('/genre')->group(function () {
        Route::get('/', [FilmGenreController::class, 'index']);
    });

    Route::prefix('/status')->group(function () {
        Route::get('/', [FilmStatusController::class, 'index']);
    });

    Route::prefix('/type')->group(function () {
        Route::get('/', [FilmTypeController::class, 'index']);
    });

    Route::prefix('/recommended')->group(function () {
        Route::get('/', [FilmRecommendedController::class, 'index']);
        Route::middleware('auth:api')->group(function () {
            Route::post('/', [FilmRecommendedController::class, 'store']);
            Route::delete('/{film}', [FilmRecommendedController::class, 'destroy']);
        });
    });

    Route::middleware(['auth:api', 'verified'])->group(function () {
        Route::prefix('/watched')->group(function () {
            Route::get('/', [FilmWatchedController::class, 'index']);
            Route::post('/', [FilmWatchedController::class, 'store']);
            Route::delete('/{film}', [FilmWatchedController::class, 'destroy']);
        });

        Route::prefix('/want-to-watch')->group(function () {
            Route::get('/', [FilmWantWatchController::class, 'index']);
            Route::post('/', [FilmWantWatchController::class, 'store']);
            Route::delete('/{film}', [FilmWantWatchController::class, 'destroy']);
        });

        Route::prefix('/tracked')->group(function () {
            Route::get('/', [FilmTrackedController::class, 'index']);
            Route::post('/', [FilmTrackedController::class, 'store']);
            Route::delete('/{film}', [FilmTrackedController::class, 'destroy']);
        });
    });

    Route::get('/', [FilmController::class, 'index']);
    Route::get('/search', [FilmController::class, 'search']);
    Route::get('/suggestions', [FilmController::class, 'suggestions']);
    Route::get('/{film}', [FilmController::class, 'show']);
});

Route::prefix('/email')->group(function () {
    Route::post('/verify', [EmailVerificationController::class, 'verify'])
        ->middleware(['auth:api']);

    Route::post('/resend', [EmailVerificationController::class, 'resend'])
        ->middleware(['auth:api', 'throttle:api,6,1']);
});

Route::get('/codes', function () {
    return UserVerifyCode::all();
});
