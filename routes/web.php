<?php

use App\Http\Controllers\FilmController;
use App\Http\Controllers\FilmParserController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\UserController;
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
Route::get('/film/{film}', [FilmController::class, 'index'])->name('film');
Route::get('/parse', [FilmParserController::class, 'store']);

Route::prefix('/user')->group(function () {
    Route::get('/', [UserController::class, 'index']);
});
