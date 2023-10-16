<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ForgotViewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['string', 'email'],
            'token' => ['string'],
        ];
    }

    public function attributes(): array
    {
        return [
            'email' => 'メールアドレス',
            'token' => 'トークン',
        ];
    }
}
