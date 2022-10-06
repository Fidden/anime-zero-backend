<?php

namespace App\Http\Controllers;

use App\Http\Resources\BaseNameValueResource;
use App\Models\Status;
use App\Services\ResponseService;

class FilmStatusController extends Controller
{
    public function index()
    {
        return ResponseService::success(
            BaseNameValueResource::collection(
                Status::all()
            )
        );
    }
}
