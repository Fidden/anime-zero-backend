<?php

namespace App\Http\Controllers;

use App\Http\Resources\FilmResource;
use App\Models\Film;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(Film $flilm): \Inertia\Response
    {
        return Inertia::render('FilmPage', [
            'item' => FilmResource::make($flilm)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function show(Film $film)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Film $film)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function destroy(Film $film)
    {
        //
    }
}
