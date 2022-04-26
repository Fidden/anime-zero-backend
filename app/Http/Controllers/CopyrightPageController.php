<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class CopyrightPageController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('CopyrightPage');
    }
}
