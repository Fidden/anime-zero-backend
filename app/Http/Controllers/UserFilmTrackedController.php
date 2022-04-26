<?php

namespace App\Http\Controllers;

use App\Http\Resources\FilmResource;
use App\Models\{Film, TrackedFilm};
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
        $user = auth()->user();
        //Film::whereIn('id', TrackedFilm::where('user_id', auth()->id())->pluck('film_id'))->paginate(10)
        return Inertia::render('AccountFilmsPage', [
            'films' => FilmResource::collection(
                $user->trackedFilm()->paginate(10))
        ]);
    }
}
