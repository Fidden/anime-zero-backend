<?php

namespace App\Http\Controllers;

use App\Http\Resources\BaseNameValueResource;
use App\Models\Type;
use App\Services\ResponseService;

class FilmTypeController extends Controller
{
    public function index()
    {
        return ResponseService::success(
            BaseNameValueResource::collection(
                Type::all()
            )
        );
    }
}
