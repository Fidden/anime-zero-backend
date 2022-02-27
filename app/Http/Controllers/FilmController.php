<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilmSearchQuery;
use App\Http\Requests\FilmSearchQueryRequest;
use App\Http\Resources\FilmResource;
use App\Models\Film;
use App\Models\WantToWatchFilm;
use App\Models\WatchedFilm;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(): \Inertia\Response
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

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
            'is_wanted_watch' => $user && WantToWatchFilm::where([['user_id', $user->id], ['film_id', $film->id]])->exists(),
            'is_watched' => $user && WatchedFilm::where([['user_id', $user->id], ['film_id', $film->id]])->exists(),
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
            ->orWhere('title_orig', 'like', "%{$query}%")->get());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Film $film
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Film $film)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Film $film
     * @return \Illuminate\Http\Response
     */
    public function destroy(Film $film)
    {
        //
    }
}
