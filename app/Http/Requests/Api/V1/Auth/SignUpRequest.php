<?php

namespace App\Http\Requests\Api\V1\Auth;

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
            'name' => ['string', Rule::requiredIf(function () {
                return $this->type == UserTypeEnum::Provider->value;
            })],
            'email' => ['nullable', 'email:rfc,dns', Rule::unique('users', 'email')],
            'phone' => ['required',    'digits_between:9,12', new Phone, Rule::unique('users', 'phone')->ignore(auth('api')->id())],
//            'password' => ['required', Password::min(8)->letters()->numbers()->symbols()],
            'fcm_token' => ['nullable', 'string'],
            'type' => ['required', Rule::in(UserTypeEnum::values())],
            'image' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
            'brand_name' => ['string', Rule::requiredIf(function () {
                return $this->type == UserTypeEnum::Provider->value;
            })],
        ];
    }
}
