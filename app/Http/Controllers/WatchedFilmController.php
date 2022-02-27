<?php

namespace App\Http\Controllers;

use App\Http\Requests\WatchedFilmStoreRequest;
use App\Models\WatchedFilm;
use Illuminate\Http\Request;

class WatchedFilmController extends Controller
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
     * @param WatchedFilmStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(WatchedFilmStoreRequest $request): \Illuminate\Http\RedirectResponse
    {
        WatchedFilm::create($request->validated());
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\WatchedFilm $watchedFilm
     * @return \Illuminate\Http\Response
     */
    public function show(WatchedFilm $watchedFilm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\WatchedFilm $watchedFilm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WatchedFilm $watchedFilm)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $film_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $film_id): \Illuminate\Http\RedirectResponse
    {
        WatchedFilm::where([['user_id', auth()->id()], ['film_id', $film_id]])->delete();
        return redirect()->back();
    }
}
