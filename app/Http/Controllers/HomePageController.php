<?php

namespace App\Http\Controllers;

use App\Http\Resources\FilmResource;
use App\Models\Film;
use App\Models\Status;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomePageController extends Controller
{
    public function __invoke(): \Inertia\Response
    {
        return Inertia::render('HomePage', [
            'best_films' => FilmResource::collection(Film::orderBy('rating', 'desc')->limit(9)->get()),
            'newest_films' => FilmResource::collection(Film::orderBy('year', 'desc')->orderBy('rating', 'desc')->limit(6)->get()),
            'ongoing_films' => FilmResource::collection(Film::where('status_id', Status::where('name', 'ongoing')->value('id'))->limit(4)->get())
        ]);
    }
}
