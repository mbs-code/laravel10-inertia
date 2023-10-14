<?php

namespace App\Http\Controllers;

use Illuminate\Mail\Markdown;
use Illuminate\Support\Facades\File;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function view(): Response
    {
        $md = File::get(base_path('README.md'));
        $readme = Markdown::parse($md)->toHtml();

        return Inertia::render('Home', [
            'readme' => $readme,
        ]);
    }
}
