<?php

namespace App\Http\Controllers;

use App\Http\Resources\TrackedFilmResource;
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
        return Inertia::render('AccountFilmsPage', [
            'films' => TrackedFilmResource::collection($user->trackedFilm()->paginate(10))
        ]);
    }
}
