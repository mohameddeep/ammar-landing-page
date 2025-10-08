<?php

namespace App\Http\Requests\Dashboard\Provider;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class ProviderRequest extends FormRequest
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
            'brand_name' => ['required', 'string'],
            'phone' => ['required', 'string', 'unique:users,phone',    'regex:/^(\+9665|9665|05)[0-9]{8}$/',
],
            'type' => ['nullable','in:provider'],
        ];
    }
}
