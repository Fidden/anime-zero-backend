<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class FilmGenreResource extends JsonResource
{
    public function toArray($request): array|Arrayable|JsonSerializable
    {
        return [
            'id' => $this->genre->id,
            'name' => $this->genre->name,
            'value' => $this->genre->value,
        ];
    }
}
