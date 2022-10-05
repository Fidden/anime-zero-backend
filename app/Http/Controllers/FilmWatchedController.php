<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilmWatchedStoreRequest;
use App\Http\Resources\FilmWatchedResource;
use App\Models\Film;
use App\Services\ResponseService;

class FilmWatchedController extends Controller
{
    public function index()
    {
        return FilmWatchedResource::collection(
            auth()
                ->user()
                ->filmsWatched()
                ->orderBy('updated_at', 'desc')
                ->paginate(10)
        );
    }

    public function store(FilmWatchedStoreRequest $request)
    {
        $user = auth()->user();

        if ($user->filmsWatched()->where('film_id', $request->film_id)->exists()) {
            return ResponseService::error(
                'Film already in want to watch list',
                400,
                ['film' => 'film_id must be unique for user']
            );
        }

        $user->filmsWatched()
            ->create($request->validated());

        return response(null, 201);
    }

    public function destroy(Film $film)
    {
        auth()
            ->user()
            ->filmsWatched()
            ->where('film_id', $film->id)
            ->delete();

        return response(null, 200);
    }
}
