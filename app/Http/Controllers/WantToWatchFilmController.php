<?php

namespace App\Http\Controllers;

use App\Http\Requests\WantToWatchFilmStoreRequest;
use App\Models\WantToWatchFilm;
use Illuminate\Http\Request;

class WantToWatchFilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

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
     * Display the specified resource.
     *
     * @param \App\Models\WantToWatchFilm $wantToWatchFilm
     * @return \Illuminate\Http\Response
     */
    public function show(WantToWatchFilm $wantToWatchFilm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\WantToWatchFilm $wantToWatchFilm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WantToWatchFilm $wantToWatchFilm)
    {
        //
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
