<?php

namespace App\Http\Controllers;

use App\Http\Resources\GenreResource;
use App\Models\Genre;
use App\Services\ResponseService;

class FilmGenreController extends Controller
{
    function index()
    {
        return ResponseService::success(
            GenreResource::collection(
                Genre::all()
            )
        );
    }
}
