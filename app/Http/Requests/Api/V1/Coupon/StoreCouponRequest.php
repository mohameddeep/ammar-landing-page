<?php

namespace App\Http\Requests\Api\V1\Coupon;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCouponRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'provider_id' => auth()->user()->id,
            'type' => 'provider',
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'code' => [
                'required',
                Rule::unique('coupons')->ignore($this->coupon),
            ],
            'name' => 'nullable',
            'type' => 'nullable',
            'provider_id' => 'required|exists:users,id',
            'discount' => 'required|numeric|min:0|max:100',
            'usage_count' => 'required|integer|min:1',
            'expire_at' => 'required|date|after_or_equal:today',
        ];
    }

    public function messages(): array
    {
        return [
            'code.required' => 'كود الخصم مطلوب.',
            'code.unique' => 'هذا الكود مستخدم من قبل.',

            'name.required' => 'الاسم مطلوب.',

            'discount.required' => 'قيمة الخصم مطلوبة.',
            'discount.numeric' => 'قيمة الخصم يجب أن تكون رقمًا.',
            'discount.min' => 'قيمة الخصم لا يمكن أن تكون أقل من 0.',
            'discount.max' => 'قيمة الخصم لا يمكن أن تتجاوز 100.',

            'usage_count.required' => 'عدد مرات الاستخدام مطلوب.',
            'usage_count.integer' => 'عدد مرات الاستخدام يجب أن يكون عددًا صحيحًا.',
            'usage_count.min' => 'عدد مرات الاستخدام يجب أن يكون 1 على الأقل.',

            'expire_at.date' => 'تاريخ الانتهاء يجب أن يكون تاريخًا صالحًا.',
            'expire_at.after_or_equal' => 'تاريخ الانتهاء يجب أن يكون اليوم أو بعده.',
        ];
    }
}
