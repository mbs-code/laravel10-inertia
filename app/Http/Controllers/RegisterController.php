<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class RegisterController extends Controller
{
    public function view(): Response
    {
        return Inertia::render('Register');
    }

    public function store(RegisterRequest $request): RedirectResponse
    {
        $request->execute(new User());

        return redirect(RouteServiceProvider::HOME);
    }
}
