<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    const ONGOING = 'ongoing';
    const RELEASED = 'released';
    const ANNOUNCED = 'announced';
    const UNKNOWN = 'unknown';

    protected $fillable = [
        'name',
        'value',
    ];
}
