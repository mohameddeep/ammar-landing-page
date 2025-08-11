<?php

namespace App\Http\Requests\Api\V1\Auth\Merchant;

use App\Enums\UserTypeEnum;
use App\Rules\Phone;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class SignUpRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'email:rfc,dns', Rule::unique('merchants', 'email')],
            'phone' => ['required', new Phone, Rule::unique('merchants', 'phone')->ignore(auth('merchant-api')->id())],
            'password' => ['required', Password::min(8)->letters()->numbers()->symbols()],
            'type' => ['required', Rule::in(UserTypeEnum::values())],
            'fcm_token' => ['nullable', 'string'],
        ];
    }
}
