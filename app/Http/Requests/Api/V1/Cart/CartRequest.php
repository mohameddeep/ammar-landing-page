<?php

namespace App\Http\Requests\Api\V1\Cart;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CartRequest extends FormRequest
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
        $isPost = $this->method() === 'POST';
        return [
            'product_id' => [Rule::requiredIf($isPost), 'exists:products,id'],
            'quantity'   => ['required', 'integer', 'min:1'],
            'size'       => [Rule::requiredIf($isPost), 'string'],
            'color'      => [Rule::requiredIf($isPost), 'string'],
            'can_change' => 'nullable|boolean'
        ];
    }
}
