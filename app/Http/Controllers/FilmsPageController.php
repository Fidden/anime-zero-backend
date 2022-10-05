<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilmsPageIndexRequest;
use App\Http\Resources\{ContentTypeResource, FilmResource, GenreResource, StatusResource};
use App\Models\{ContentType, Film, FilmGenre, Genre, Status};
use Illuminate\Database\Eloquent\Builder;
use Inertia\Inertia;

class FilmsPageController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param FilmsPageIndexRequest $request
     * @return \Inertia\Response
     */
    public function __invoke(FilmsPageIndexRequest $request): \Inertia\Response
    {
        $films = Film::query()
            ->when($request->has('genres'), function (Builder $query) use ($request) {
                $query->whereIn('id',
                    FilmGenre::whereIn('genre_id',
                        Genre::whereIn('name', $request->genres)
                            ->pluck('id'))
                        ->pluck('film_id'));
            })
            ->when($request->has('statuses'), function (Builder $query) use ($request) {
                $query->whereIn('film_status_id',
                    Status::whereIn('name', $request->statuses)
                        ->pluck('id'));
            })
            ->when($request->has('type'), function (Builder $query) use ($request) {
                $query->where('film_type_id',
                    ContentType::where('name', $request->type)
                        ->pluck('id'));
            })
            ->when(($request->has('years') && $request->get('years') != 'Все'), function (Builder $query) use ($request) {
                $years_array = str($request->years)->explode('-');
                $query->where([['year', '>=', $years_array[0]], ['year', '<=', $years_array[1]]]);
            })
            ->when($request->get('rating') == 'По убыванию',
                function (Builder $query) {
                    $query->orderBy('rating', 'desc');
                },
                function (Builder $query) {
                    $query->orderBy('rating');
                }
            )
            ->when($request->get('title') == 'По убыванию (Я-а)',
                function (Builder $query) {
                    $query->orderBy('title', 'desc');
                },
                function (Builder $query) {
                    $query->orderBy('title');
                }
            );

        return Inertia::render('FilmsPage', [
            'films' => FilmResource::collection($films->paginate(18)->onEachSide(1)),
            'genres' => GenreResource::collection(Genre::all()),
            'statuses' => StatusResource::collection(Status::all()),
            'contentTypes' => ContentTypeResource::collection(ContentType::all()),
        ]);
    }
}
