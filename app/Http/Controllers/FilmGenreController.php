<?php

namespace App\Http\Controllers;

use App\Http\Resources\GenreResource;
use App\Http\Services\ResponseService;
use App\Models\Genre;

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
