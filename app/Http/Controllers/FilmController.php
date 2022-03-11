<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilmSearchQueryRequest;
use App\Http\Resources\FilmResource;
use App\Models\Film;
use App\Models\WantToWatchFilm;
use App\Models\WatchedFilm;
use Inertia\Inertia;

class FilmController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param \App\Models\Film $film
     * @return \Inertia\Response
     */
    public function show(Film $film): \Inertia\Response
    {
        $user = auth()->check() ? auth()->user() : null;

        return Inertia::render('FilmPage', [
            'item' => FilmResource::make($film),
            'isWantedWatch' => $user && WantToWatchFilm::where([['user_id', $user->id], ['film_id', $film->id]])->exists(),
            'isWatched' => $user && WatchedFilm::where([['user_id', $user->id], ['film_id', $film->id]])->exists(),
        ]);
    }


    /**
     * Display the specified resource found by query.
     * @param FilmSearchQueryRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function search(FilmSearchQueryRequest $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $query = $request->input('query');
        return FilmResource::collection(Film::where('title', 'like', "%{$query}%")
            ->orWhere('title_orig', 'like', "%{$query}%")->limit(6)->get());
    }
}
