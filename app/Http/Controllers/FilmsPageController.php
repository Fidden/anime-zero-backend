<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilmsPageIndexRequest;
use App\Http\Resources\FilmResource;
use App\Http\Resources\GenreResource;
use App\Models\Film;
use App\Models\FilmGenre;
use App\Models\Genre;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FilmsPageController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Inertia\Response
     */
    public function __invoke(FilmsPageIndexRequest $request)
    {
        $films = Film::query();

        if ($request->has('genres'))
            $films =
                $films->whereIn('id',
                    FilmGenre::whereIn('genre_id',
                        Genre::whereIn('name', $request->genres)
                            ->pluck('id'))
                        ->pluck('film_id'));

        return Inertia::render('FilmsPage', [
            'films' => FilmResource::collection($films->paginate(18)->onEachSide(1)),
            'genres' => GenreResource::collection(Genre::all()),
        ]);
    }
}
