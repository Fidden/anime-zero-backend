<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilmWantWatchStoreRequest;
use App\Http\Resources\FilmResource;
use App\Http\Resources\FilmWantWatchResource;
use App\Models\Film;
use App\Services\ResponseService;

class FilmWantWatchController extends Controller
{
    public function all()
    {
        return ResponseService::success(
            auth()
                ->user()
                ->filmsWantWatch()
                ->pluck('film_id')
        );
    }

    public function index()
    {
        return FilmWantWatchResource::collection(
            auth()
                ->user()
                ->filmsWantWatch()
                ->orderBy('updated_at', 'desc')
                ->paginate(10)
        );
    }

    public function store(FilmWantWatchStoreRequest $request)
    {
        $user = auth()->user();

        if ($user->filmsWantWatch()->where('film_id', $request->film_id)->exists()) {
            return ResponseService::error(
                'Film already in want to watch list',
                400,
                ['film' => 'film_id must be unique for user']
            );
        }

        $user->filmsWantWatch()
            ->create($request->validated());

        return response(null, 201);
    }

    public function destroy(Film $film)
    {
        auth()
            ->user()
            ->filmsWantWatch()
            ->where('film_id', $film->id)
            ->delete();

        return response(null, 200);
    }
}
