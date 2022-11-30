<?php

namespace App\Http\Controllers;

use App\Http\Filters\FilmQuery;
use App\Http\Requests\Film\FilmIndexRequest;
use App\Http\Requests\Film\FilmSearchRequest;
use App\Http\Resources\FilmResource;
use App\Models\Film;
use App\Services\ResponseService;
use Illuminate\Database\Query\Builder;

class FilmController extends Controller
{
    public function index(FilmIndexRequest $request)
    {
        return FilmResource::collection(
            Film::filter(
                FilmQuery::make(
                    $request->only('genres', 'statuses', 'type', 'years', 'rating', 'title')
                )
            )->paginate(18)
        );
    }

    public function show(Film $film)
    {
        return ResponseService::success(
            FilmResource::make($film)
        );
    }

    public function suggestions(FilmSearchRequest $request)
    {
        return ResponseService::success(
            FilmResource::collection(
                Film::search($request->input('query'))
                    ->query(fn(Builder $builder) => $builder->limit(10))
                    ->get()
            )
        );
    }

    public function search(FilmSearchRequest $request)
    {
        return ResponseService::success(
            FilmResource::collection(
                Film::search($request->input('query'))
                    ->paginate(18)
            )
        );
    }
}
