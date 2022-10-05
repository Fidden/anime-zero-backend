<?php

namespace App\Http\Controllers;

use App\Http\Requests\Film\FilmIndexRequest;
use App\Http\Requests\Film\FilmSearchRequest;
use App\Http\Resources\FilmResource;
use App\Models\Film;
use App\Models\FilmGenre;
use App\Models\FilmStatus;
use App\Models\FilmType;
use App\Models\Genre;
use App\Services\ResponseService;
use Illuminate\Database\Eloquent\Builder;

class FilmController extends Controller
{
    public function index(FilmIndexRequest $request)
    {
        $films = Film::when($request->has('genres'), function (Builder $builder) use ($request) {
            $genres = str($request->genres)->explode(',');

            $builder->whereIn('id',
                FilmGenre::whereIn('genre_id',
                    Genre::whereIn('value', $genres)
                        ->pluck('id'))
                    ->pluck('film_id'));
        })
            ->when($request->has('statuses'), function (Builder $query) use ($request) {
                $query->whereIn('status_id',
                    FilmStatus::whereIn('value', str($request->statuses)->explode(','))
                        ->pluck('id'));
            })
            ->when($request->has('type'), function (Builder $query) use ($request) {
                $query->where('content_type_id',
                    FilmType::where('value', str($request->type)->explode(','))
                        ->pluck('id'));
            })
            ->when(($request->has('years')), function (Builder $query) use ($request) {
                $years_array = str($request->years)->explode('-');
                $query->where([['year', '>=', $years_array[0]], ['year', '<=', $years_array[1]]]);
            })
            ->when($request->get('rating') == 'desc',
                function (Builder $query) {
                    $query->orderBy('rating', 'desc');
                },
                function (Builder $query) {
                    $query->orderBy('rating');
                }
            )
            ->when($request->get('title') == 'desc',
                function (Builder $query) {
                    $query->orderBy('title', 'desc');
                },
                function (Builder $query) {
                    $query->orderBy('title');
                }
            );

        return FilmResource::collection(
            $films->paginate(18)->onEachSide(1)
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
