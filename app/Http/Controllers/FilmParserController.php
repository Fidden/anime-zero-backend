<?php

namespace App\Http\Controllers;

use App\Jobs\ParseJob;

class FilmParserController extends Controller
{
    public function store()
    {
        ParseJob::dispatch();
    }
}
