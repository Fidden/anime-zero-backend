<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class UserResource extends JsonResource
{
    public function toArray($request): array|Arrayable|JsonSerializable
    {
        return [
            'login' => $this->login,
            'email' => $this->email,
            'avatar' => $this->avatar,
            'role' => $this->role->name,
            'verified' => $this->hasVerifiedEmail(),
        ];
    }
}
