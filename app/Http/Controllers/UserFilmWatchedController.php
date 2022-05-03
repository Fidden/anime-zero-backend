<?php

namespace App\Http\Controllers;

use App\Http\Resources\WatchedFilmResource;
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
        $user = auth()->user();
        return Inertia::render('AccountFilmsPage', [
            'films' => WatchedFilmResource::collection($user->watchedFilms()->paginate(10))
        ]);
    }
}
