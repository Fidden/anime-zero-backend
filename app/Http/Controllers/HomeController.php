<?php

namespace App\Http\Controllers;

use App\Http\Requests\HomeIndexRequest;
use App\Http\Resources\FilmPreviewResource;
use App\Http\Resources\FilmRecommendedResource;
use App\Http\Resources\FilmResource;
use App\Models\Film;
use App\Models\FilmRecommended;
use App\Models\Status;
use App\Services\ResponseService;
use Illuminate\Database\Eloquent\Builder;

class HomeController extends Controller
{
    public function index(HomeIndexRequest $request)
    {
        $request->blocks = str($request->blocks)->explode(',');
        $entities = [];

        if ($request->blocks->contains('preview')) {
            $entities['preview'] =
                FilmPreviewResource::collection(
                    Film::orderBy('rating', 'desc')
                        ->limit(12)
                        ->get());
        }

        if ($request->blocks->contains('newest')) {
            $entities['newest'] =
                FilmResource::collection(
                    Film::orderBy('year', 'desc')
                        ->orderBy('rating', 'desc')
                        ->limit(12)
                        ->get());
        }

        if ($request->blocks->contains('ongoing')) {
            $entities['ongoing'] =
                FilmResource::collection(
                    Film::whereHas('status', function (Builder $builder) {
                        $builder->where('value', Status::ONGOING);
                    })
                        ->limit(12)
                        ->get()
                );
        }

        if ($request->blocks->contains('recommended')) {
            $entities['recommended'] = FilmRecommendedResource::collection(
                FilmRecommended::all()
            );
        }

        return ResponseService::success($entities);
    }
}
