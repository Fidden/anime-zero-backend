<?php

namespace App\Http\Controllers;

use App\Http\Resources\FilmResource;
use App\Models\Film;
use App\Models\TrackedFilm;
use App\Models\WantToWatchFilm;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserFilmTrackedController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Inertia\Response
     */
    public function __invoke(Request $request): \Inertia\Response
    {
        return Inertia::render('AccountFilmsPage', [
            'films' => FilmResource::collection(
                Film::whereIn('id', TrackedFilm::where('user_id', auth()->id())->pluck('film_id'))->paginate(10))
        ]);
    }
}
