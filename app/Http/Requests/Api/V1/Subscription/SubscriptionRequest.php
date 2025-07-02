<?php

namespace App\Http\Requests\Api\V1\Subscription;

use Illuminate\Foundation\Http\FormRequest;

class SubscriptionRequest extends FormRequest
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
            'merchant_id' => ['required', 'exists:merchants,id'],
            'package_id' => ['required', 'exists:packages,id'],
            'price' => ['required'],
            // "status" =>["required"],
            'end_date' => ['nullable', 'date'],
            'is_active' => ['nullable', 'in:0,1'],
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'merchant_id' => auth('merchant-api')->user()->id,
            'is_active' => 1,
        ]);
    }
}
