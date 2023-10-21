<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class PasswordForgotRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
        ];
    }

    public function attributes(): array
    {
        return [
            'email' => 'メールアドレス',
        ];
    }

    public function execute(): void
    {
        // メール送信処理の実行
        $status = Password::sendResetLink(
            $this->only('email')
        );

        // エラー確認
        if ($status !== Password::RESET_LINK_SENT) {
            throw ValidationException::withMessages([
                'email' => [trans($status)],
            ]);
        }

        Log::info("<password-forgot> send to {$this->email}");
    }
}
