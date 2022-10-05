<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilmRecommendedStoreRequest;
use App\Http\Resources\FilmResource;
use App\Http\Services\ResponseService;
use App\Models\Film;
use App\Models\FilmRecommended;
use Illuminate\Auth\Access\AuthorizationException;

class FilmRecommendedController extends Controller
{
    public function index()
    {
        return ResponseService::success(
            FilmResource::collection(
                FilmRecommended::latest()->limit(3)->get()
            )
        );
    }

    public function store(FilmRecommendedStoreRequest $request)
    {
        FilmRecommended::create($request->validated());
        return ResponseService::created();
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(Film $film)
    {
        // if request user has admin rights
        $this->authorize('admin');

        $film->recommended()->delete();
        return ResponseService::noContent();
    }
}
