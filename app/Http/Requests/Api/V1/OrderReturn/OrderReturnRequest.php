<?php

namespace App\Http\Requests\Api\V1\OrderReturn;

use Illuminate\Foundation\Http\FormRequest;

class OrderReturnRequest extends FormRequest
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
            'address_id' => 'required|exists:user_addresses,id',
            'reason' => ['required', 'string'],
            'comment' => ['nullable', 'string'],
        ];
    }
}
