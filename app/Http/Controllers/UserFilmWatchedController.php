<?php

namespace App\Http\Controllers;

use App\Http\Resources\FilmResource;
use App\Models\Film;
use App\Models\WatchedFilm;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserFilmWatchedController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Inertia\Response
     */
    public function __invoke(Request $request)
    {
        return Inertia::render('AccountFilmsPage', [
            'films' => FilmResource::collection(
                Film::whereIn('id',
                    WatchedFilm::where('user_id', auth()->id())->pluck('film_id'))
                    ->paginate(10))
        ]);
    }
}
