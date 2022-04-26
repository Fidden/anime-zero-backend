<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class PrivacyPageController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('PrivacyPolicyPage');
    }
}
