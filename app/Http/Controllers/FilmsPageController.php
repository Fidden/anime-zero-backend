<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilmsPageIndexRequest;
use App\Http\Resources\ContentTypeResource;
use App\Http\Resources\FilmResource;
use App\Http\Resources\GenreResource;
use App\Http\Resources\StatusResource;
use App\Models\ContentType;
use App\Models\Film;
use App\Models\FilmGenre;
use App\Models\Genre;
use App\Models\Status;
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
    public function __invoke(FilmsPageIndexRequest $request): \Inertia\Response
    {
        $films = Film::query();

        if ($request->has('genres'))
            $films->whereIn('id',
                FilmGenre::whereIn('genre_id',
                    Genre::whereIn('name', $request->genres)
                        ->pluck('id'))
                    ->pluck('film_id'));

        if ($request->has('statuses'))
            $films->whereIn('status_id',
                Status::whereIn('name', $request->statuses)->pluck('id'));

        if ($request->has('type'))
            $films->where('content_type_id',
                ContentType::where('name', $request->type)->pluck('id'));

        return Inertia::render('FilmsPage', [
            'films' => FilmResource::collection($films->paginate(18)->onEachSide(1)),
            'genres' => GenreResource::collection(Genre::all()),
            'statuses' => StatusResource::collection(Status::all()),
            'contentTypes' => ContentTypeResource::collection(ContentType::all()),
        ]);
    }
}
