<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilmSearchQueryRequest;
use App\Http\Resources\FilmResource;
use App\Models\{Film, WantToWatchFilm, WatchedFilm};
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
        $user = auth()->user();
        if ($user)
            $condition = [['user_id', $user->id], ['film_id', $film->id]];

        return Inertia::render('FilmPage', [
            'item' => FilmResource::make($film),
            'isWantedWatch' => $user && WantToWatchFilm::where($condition)->exists(),
            'isWatched' => $user && WatchedFilm::where($condition)->exists(),
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
