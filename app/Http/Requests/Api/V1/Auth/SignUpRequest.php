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
            'phone' => [
                'required',
                'regex:/^(\+9665|9665|05)[0-9]{8}$/',
                new Phone,
                Rule::unique('users', 'phone')->ignore(auth('api')->id())
            ],
            //'password' => ['required', Password::min(8)->letters()->numbers()->symbols()],
            'fcm_token' => ['nullable', 'string'],
            'type' => ['required', Rule::in(UserTypeEnum::values())],
            'image' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
            'brand_name' => ['string', Rule::requiredIf(function () {
                return $this->type == UserTypeEnum::Provider->value;
            })],
        ];
    }
    
    
     public function messages(): array
    {
        return [
            'name.required' => __('validation.name_required'),
            'name.string' => __('validation.name_string'),

            'email.email' => __('validation.email_email'),
            'email.unique' => __('validation.email_unique'),

            'phone.required' => __('validation.phone_required'),
            'phone.regex' => __('validation.phone_regex'),
            'phone.unique' => __('validation.phone_unique'),

            'type.required' => __('validation.type_required'),
            'type.in' => __('validation.type_in'),

            'image.required' => __('validation.image_required'),
            'image.image' => __('validation.image_image'),
            'image.mimes' => __('validation.image_mimes'),
            'image.max' => __('validation.image_max'),

            'brand_name.required' => __('validation.brand_name_required'),
            'brand_name.string' => __('validation.brand_name_string'),

            'fcm_token.string' => __('validation.fcm_token_string'),
        ];
    }
}
