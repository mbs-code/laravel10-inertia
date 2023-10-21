<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordResetRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Inertia\Response;

class PasswordResetController extends Controller
{
    public function view(Request $request): Response
    {
        $user = null;

        // 入力値が問題ないか確認
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email'],
            'token' => ['required','string'],
        ]);

        // 組み合わせがあっているか確認
        if (!$validator->fails()) {
            $user = Password::getUser($request->only('email', 'token'));
        }

        return Inertia::render('PasswordReset', [
            'user' => $user,
            'email' => $request->email,
            'token' => $request->token,
        ]);
    }

    public function store(PasswordResetRequest $request): Response
    {
        $request->execute();

        return Inertia::render('PasswordResetComplete');
    }
}
