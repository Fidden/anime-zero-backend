<?php

namespace App\Http\Controllers;

use App\Http\Requests\WantToWatchFilmStoreRequest;
use App\Models\WantToWatchFilm;

class WantToWatchFilmController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(WantToWatchFilmStoreRequest $request): \Illuminate\Http\RedirectResponse
    {
        WantToWatchFilm::firstOrCreate($request->validated());
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\WantToWatchFilm $wantToWatchFilm
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $film_id): \Illuminate\Http\RedirectResponse
    {
        WantToWatchFilm::where([['user_id', auth()->id()], ['film_id', $film_id]])->delete();
        return redirect()->back();
    }
}
