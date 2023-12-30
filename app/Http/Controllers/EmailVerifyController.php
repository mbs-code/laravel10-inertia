<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class EmailVerifyController extends Controller
{
    public function view(Request $request): RedirectResponse
    {
        $user = $request->user();

        // if ($request->user()->hasVerifiedEmail()) {
        //     return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
        // }

        // if ($request->user()->markEmailAsVerified()) {
        //     event(new Verified($request->user()));
        // }

        // return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
        // dd($request->user());
        // return Inertia::render('PasswordForgot');

        // session()->toast('info', 'ユーザー登録しました。');
        return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
    }
}
