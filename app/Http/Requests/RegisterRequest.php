<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rules\Unique;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $uniqueEmail = Rule::unique(User::class, 'email')->ignore($this->user?->id);

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', $uniqueEmail],
            'password' => ['required', 'confirmed', Password::defaults()],
        ];
    }

    public function execute(User $user): void
    {
        // ユーザーの新規作成
        $user = $user
            ->fill($this->validated())
            ->fill(['password' => Hash::make($this->password)])
            ->save();


        event(new Registered($user));

        // ログインさせる
        Auth::login($user);
    }
}
