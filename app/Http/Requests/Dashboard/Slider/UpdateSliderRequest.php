<?php

declare(strict_types=1);

namespace App\Http\Requests\Dashboard\Slider;

use Illuminate\Foundation\Http\FormRequest;

final class UpdateSliderRequest extends FormRequest
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
           'title_one_ar' => 'nullable|string|max:255',
            'title_one_en' => 'nullable|string|max:255',
            'title_two_ar' => 'nullable|string|max:255',
            'title_two_en' => 'nullable|string|max:255',
            'title_three_ar' => 'nullable|string|max:255',
            'title_three_en' => 'nullable|string|max:255',
            'content_ar' => 'nullable|string',
            'content_en' => 'nullable|string',

            'image' => 'nullable|mimes:jpeg,png,jpg',
        ];
    }
}
