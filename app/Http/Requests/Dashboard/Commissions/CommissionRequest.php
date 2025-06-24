<?php

namespace App\Http\Requests\Dashboard\Commissions;

use App\Enums\CommissionTypeEnum;
use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

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
            'type' => ['required', Rule::in(CommissionTypeEnum::values())],
        ];
    }
}
