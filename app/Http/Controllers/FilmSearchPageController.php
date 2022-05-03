<?php

namespace App\Http\Controllers;

use App\Http\Resources\FilmResource;
use App\Models\Film;
use Inertia\Inertia;

class FilmSearchPageController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Inertia\Response
     */
    public function __invoke(string $query): \Inertia\Response
    {
        return Inertia::render('FilmSearch', [
            'films' => FilmResource::collection(
                Film::where('title', 'like', "%{$query}%")
                ->orWhere('title_orig', 'like', "%{$query}%")->paginate(20)
            )
        ]);
    }
}
