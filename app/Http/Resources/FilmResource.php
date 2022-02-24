<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FilmResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
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
        ];
    }
}
