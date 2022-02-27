<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrackedFilmStoreRequest;
use App\Models\TrackedFilm;
use Illuminate\Http\Request;

class TrackedFilmController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TrackedFilmStoreRequest $request): \Illuminate\Http\RedirectResponse
    {
        TrackedFilm::create($request->validated());
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TrackedFilm  $trackedFilm
     * @return \Illuminate\Http\Response
     */
    public function show(TrackedFilm $trackedFilm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TrackedFilm  $trackedFilm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TrackedFilm $trackedFilm)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TrackedFilm  $trackedFilm
     * @return \Illuminate\Http\Response
     */
    public function destroy(TrackedFilm $trackedFilm)
    {
        //
    }
}
