<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class FilmStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'film_id',
        'status_id',
    ];

    public function status(): HasOne
    {
        return $this->hasOne(Status::class);
    }
}
