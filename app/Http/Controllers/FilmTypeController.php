<?php

namespace App\Http\Controllers;

use App\Http\Resources\BaseNameValueResource;
use App\Models\FilmType;
use App\Http\Services\ResponseService;

class FilmTypeController extends Controller
{
    public function index()
    {
        return ResponseService::success(
            BaseNameValueResource::collection(
                FilmType::all()
            )
        );
    }
}
