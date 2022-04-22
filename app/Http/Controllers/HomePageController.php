<?php

namespace App\Http\Controllers;

use App\Http\Resources\FilmResource;
use App\Models\Film;
use App\Models\RecommendedFilm;
use App\Models\Status;
use Inertia\Inertia;

class HomePageController extends Controller
{
    public function __invoke(): \Inertia\Response
    {
        return Inertia::render('HomePage', [
            'films' => [
                'best' => FilmResource::collection(
                    Film::orderBy('rating', 'desc')
                        ->limit(9)
                        ->get()),

                'newest' => FilmResource::collection(
                    Film::orderBy('year', 'desc')
                        ->orderBy('rating', 'desc')
                        ->limit(6)
                        ->get()),

                'ongoing' => FilmResource::collection(
                    Film::where('status_id',
                        Status::where('name', 'Онгоинг')
                            ->value('id'))
                        ->limit(4)->get()),

                'recommended' => FilmResource::collection(
                    Film::whereIn('id', RecommendedFilm::limit(3)->pluck('film_id'))->get()),
            ]
        ]);
    }
}
