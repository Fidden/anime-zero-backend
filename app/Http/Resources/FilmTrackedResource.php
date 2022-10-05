<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class FilmTrackedResource extends JsonResource
{
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return FilmResource::make($this->film);
    }
}
