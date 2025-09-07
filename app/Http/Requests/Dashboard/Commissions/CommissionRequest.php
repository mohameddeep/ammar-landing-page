<?php

namespace App\Http\Requests\Dashboard\Commissions;

use App\Enums\CommissionTypeEnum;
use App\Enums\CommissionValueTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CommissionRequest extends FormRequest
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
            'name_ar' => 'nullable|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'value' => 'required|integer|min:0',
            'type' => ['nullable', Rule::in(CommissionTypeEnum::values())],
            'value_type' => ['nullable', Rule::in(CommissionValueTypeEnum::values())],
        ];
    }
}
