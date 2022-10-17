<?php

namespace App\Http\Controllers;

use App\Http\Requests\Film\FilmIndexRequest;
use App\Http\Requests\Film\FilmSearchRequest;
use App\Http\Resources\FilmResource;
use App\Models\Film;
use App\Services\ResponseService;
use Illuminate\Database\Eloquent\Builder;

class FilmController extends Controller
{
    public function index(FilmIndexRequest $request)
    {
        $films = Film::when($request->has('genres'), function (Builder $builder) use ($request) {
            $builder->whereHas('genres', function (Builder $query) use ($request) {
                $query->whereHas('genre', function (Builder $subQuery) use ($request) {
                    $subQuery->whereIn('value', $request->genres);
                });
            });
        })
            ->when($request->has('statuses'), function (Builder $builder) use ($request) {
                $builder->whereHas('status', function (Builder $query) use ($request) {
                    $query->whereIn('value', $request->statuses);
                });
            })
            ->when($request->has('type'), function (Builder $builder) use ($request) {
                $builder->whereHas('type', function (Builder $query) use ($request) {
                    $query->where('value', $request->type);
                });
            })
            ->when($request->has('years'), function (Builder $query) use ($request) {
                $query->where([
                    ['year', '>=', $request->years[0]],
                    ['year', '<=', $request->years[1]]
                ]);
            })
            ->when($request->has('rating'),
                function (Builder $query) use ($request) {
                    $query->orderBy('rating', $request->get('rating'));
                }
            )
            ->when($request->has('title'),
                function (Builder $query) use ($request) {
                    $query->orderBy('title', $request->get('title'));
                }
            );

        return FilmResource::collection(
            $films->paginate(18)
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
                Film::where('title', 'like', '%' . $request->input('query') . '%')
                    ->limit(10)->get()
            )
        );
    }

    public function search(FilmSearchRequest $request)
    {
        return ResponseService::success(
            FilmResource::collection(
                Film::where('title', 'like', '%' . $request->input('query') . '%')
                    ->paginate(18)
            )
        );
    }
}
