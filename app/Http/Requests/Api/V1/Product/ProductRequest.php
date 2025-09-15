<?php

namespace App\Http\Requests\Api\V1\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
        $user = auth('api')->user();
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric'],
            'images' => ['required', 'array', 'max:4'],
            'images.*' => ['image', 'mimes:jpeg,jpg,png', 'max:2048'],
            'category_id' => ['required', 'exists:categories,id'],
            'sizes' => ['required', 'array', Rule::when($user->type == 'user', 'max:1')],
            'colors' => ['required', 'array', Rule::when($user->type == 'user', 'max:1')],
        ];
    }


}
