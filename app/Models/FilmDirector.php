<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class FilmDirector extends Model
{
    use HasFactory;

    protected $fillable = [
        'film_id',
        'director_id'
    ];

    public function director(): HasOne
    {
        return $this->hasOne(Director::class, 'id', 'director_id');
    }
}
