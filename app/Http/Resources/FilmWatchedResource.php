<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class FilmWatchedResource extends JsonResource
{
    public function toArray($request): array|Arrayable|JsonSerializable
    {
        return FilmResource::make($this->film);
    }
}
