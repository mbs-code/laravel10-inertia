<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordForgotRequest;
use Inertia\Inertia;
use Inertia\Response;

class PasswordForgotController extends Controller
{
    public function view(): Response
    {
        return Inertia::render('PasswordForgot');
    }

    public function store(PasswordForgotRequest $request): Response
    {
        $request->execute();

        return Inertia::render('PasswordForgotComplete');
    }
}
