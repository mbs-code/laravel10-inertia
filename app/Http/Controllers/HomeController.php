<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function view(): Response
    {
        return Inertia::render('Welcome');
    }
}
