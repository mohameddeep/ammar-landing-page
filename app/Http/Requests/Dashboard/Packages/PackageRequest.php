<?php

namespace App\Http\Requests\Dashboard\Packages;

use App\Enums\PackageTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PackageRequest extends FormRequest
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
            'name_ar' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'product_count' => 'required|string|max:100',
            'free_product_count' => 'nullable|integer|min:0',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1',

            'features' => 'nullable|array',
            'features.*.feature_ar' => 'required_with:features|string|max:255',
            'features.*.feature_en' => 'nullable|string|max:255',
            'features.*.is_active' => 'nullable|boolean',
        ];
    }
}
