<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class AppController extends Controller
{
    public function view(): Response
    {
        return Inertia::render('Index');
    }
}
