<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class FilmResource extends JsonResource
{
    public function toArray($request): array|Arrayable|JsonSerializable
    {
        return [
            'id' => $this->id,
            'player_link' => $this->player_link,
            'kodik_id' => $this->kodik_id,
            'title' => $this->title,
            'title_orig' => $this->title_orig,
            'description' => $this->description,
            'year' => $this->year,
            'poster' => $this->poster,
            'rating' => $this->rating,
            'minimal_age' => $this->minimal_age,
            'duration' => $this->duration,
            'genres' => FilmGenreResource::collection($this->genres),
            'status' => StatusResource::make($this->status),
        ];
    }
}
