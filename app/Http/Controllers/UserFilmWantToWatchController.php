<?php

namespace App\Http\Controllers;

use App\Http\Resources\WantToWatchResource;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserFilmWantToWatchController extends Controller
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
            'films' => WantToWatchResource::collection($user->wantToWatch()->paginate(10))
        ]);
    }
}
