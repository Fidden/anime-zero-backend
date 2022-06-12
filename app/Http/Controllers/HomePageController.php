<?php

namespace App\Http\Controllers;

use App\Http\Resources\FilmResource;
use App\Http\Resources\RecommendedFilmResource;
use App\Models\{Film, RecommendedFilm, Status};
use Inertia\Inertia;

class HomePageController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('HomePage', [
            'films' => [
                'best' => FilmResource::collection(
                    Film::orderBy('rating', 'desc')
                        ->limit(12)
                        ->get()),

                'newest' => FilmResource::collection(
                    Film::orderBy('year', 'desc')
                        ->orderBy('rating', 'desc')
                        ->limit(12)
                        ->get()),

                'ongoing' => FilmResource::collection(
                    Film::where('status_id',
                        Status::where('name', 'Онгоинг')
                            ->value('id'))
                        ->limit(4)->get()),

                'recommended' => RecommendedFilmResource::collection(RecommendedFilm::all()),
            ]
        ]);
    }
}
