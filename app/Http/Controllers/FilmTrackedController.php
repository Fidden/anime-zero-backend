<?php

namespace App\Http\Controllers;


use App\Http\Requests\FilmTracked\FilmTrackedStoreRequest;
use App\Http\Resources\FilmTrackedResource;
use App\Models\Film;
use App\Http\Services\ResponseService;

class FilmTrackedController extends Controller
{
    public function index()
    {
        return FilmTrackedResource::collection(
            auth()
                ->user()
                ->filmsTracked()
                ->orderBy('updated_at', 'desc')
                ->paginate(10)
        );
    }

    public function store(FilmTrackedStoreRequest $request)
    {
        $user = auth()->user();

        if ($user->filmsTracked()->where('film_id', $request->film_id)->exists()) {
            return ResponseService::error(
                'Film already in want to watch list',
                400,
                ['film' => 'film_id must be unique for user']
            );
        }

        $user->filmsTracked()
            ->create($request->validated());

        return response(null, 201);
    }

    public function destroy(Film $film)
    {
        auth()
            ->user()
            ->filmsTracked()
            ->where('film_id', $film->id)
            ->delete();

        return response(null, 200);
    }
}
