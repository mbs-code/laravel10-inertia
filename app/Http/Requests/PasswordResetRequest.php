<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password as RulesPassword;
use Illuminate\Validation\ValidationException;

class PasswordResetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['nullable', 'string', 'email'],
            'token' => ['nullable','string'],
            'password' => ['required', 'confirmed', RulesPassword::defaults()],
        ];
    }

    public function attributes(): array
    {
        return [
            'email' => 'メールアドレス',
            'token' => 'トークン',
        ];
    }

    public function execute(): void
    {
        // パスワードリセット処理の実行
        $status = Password::reset(
            $this->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user) {
                $user->forceFill([
                    'password' => Hash::make($this->password),
                    'remember_token' => Str::random(60),
                ])->save();
                Log::info("<password-reset> {$user->toDump()}");

                event(new PasswordReset($user));
            }
        );

        // エラー確認
        if ($status !== Password::PASSWORD_RESET) {
            throw ValidationException::withMessages([
                'email' => [trans($status)],
            ]);
        }
    }
}
