<?php

namespace App\Http\Requests\Api\V1\Auth\Password;
use App\Rules\EmailExistsInUsersOrMerchants;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class ResetPasswordRequest extends FormRequest
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
            "email" => ["required","email", new EmailExistsInUsersOrMerchants()],
            "reset_token" => "required|string",
            'password' => ['required', Password::min(8)->letters()->numbers()->symbols()]
        ];
    }
}
