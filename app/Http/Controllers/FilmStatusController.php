<?php

namespace App\Http\Controllers;

use App\Http\Resources\FilmStatusResource;
use App\Models\FilmStatus;
use App\Http\Services\ResponseService;

class FilmStatusController extends Controller
{
    public function index()
    {
        return ResponseService::success(
            FilmStatusResource::collection(
                FilmStatus::all()
            )
        );
    }
}
