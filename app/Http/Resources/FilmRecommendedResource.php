<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class FilmRecommendedResource extends JsonResource
{
    public function toArray($request): array|Arrayable|JsonSerializable
    {
        return [
            'id' => $this->film->id,
            'playerLink' => $this->film->player_link,
            'title' => $this->film->title,
            'titleOrig' => $this->film->title_orig,
            'description' => $this->film->description,
            'year' => $this->film->year,
            'poster' => $this->poster ?? $this->film->poster,
            'rating' => $this->film->rating,
            'minimalAge' => $this->film->minimal_age,
            'duration' => $this->film->duration,
            'genres' => FilmGenreResource::collection($this->film->genres),
        ];
    }
}
