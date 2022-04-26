<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrackedFilmStoreRequest;
use App\Models\TrackedFilm;

class TrackedFilmController extends Controller
{
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
}
