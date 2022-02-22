<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class HomePageController extends Controller
{
    public function __invoke(): \Inertia\Response
    {
        return Inertia::render('HomePage', [

        ]);
    }
}
