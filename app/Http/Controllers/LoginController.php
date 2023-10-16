<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class LoginController extends Controller
{
    public function view(): Response | RedirectResponse
    {
        // もしログインしていたらリダイレクトする
        if (Auth::check()) {
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        return Inertia::render('Login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->execute();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(RouteServiceProvider::INDEX);
    }
}
