<?php

namespace App\Http\Controllers;

use App\Http\Requests\WatchedFilmStoreRequest;
use App\Models\WatchedFilm;
use Illuminate\Http\RedirectResponse;

class WatchedFilmController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param WatchedFilmStoreRequest $request
     * @return RedirectResponse
     */
    public function store(WatchedFilmStoreRequest $request): RedirectResponse
    {
        WatchedFilm::create($request->validated());
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $film_id
     * @return RedirectResponse
     */
    public function destroy(int $film_id): RedirectResponse
    {
        $user = auth()->user();
        $user->watchedFilms()->where('film_id', $film_id)->delete();
        return redirect()->back();
    }
}
