<?php

namespace App\Http\Requests\Api\V1\Coupon;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCouponRequest extends FormRequest
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
            'provider_id' => auth()->id(),
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
                'nullable',
                Rule::unique('coupons')->ignore($this->coupon), // تجاهل الكوبون الحالي
            ],
            'name' => 'nullable|string',
            'provider_id' => 'nullable|exists:users,id',
            'discount' => 'nullable|numeric|min:0|max:100',
            'usage_count' => 'nullable|integer|min:1',
            'expire_at' => 'nullable|date|after_or_equal:today',
        ];
    }

    public function messages(): array
    {
        return [
            'code.unique' => 'هذا الكود مستخدم من قبل.',

            'discount.numeric' => 'قيمة الخصم يجب أن تكون رقمًا.',
            'discount.min' => 'قيمة الخصم لا يمكن أن تكون أقل من 0.',
            'discount.max' => 'قيمة الخصم لا يمكن أن تتجاوز 100.',

            'usage_count.integer' => 'عدد مرات الاستخدام يجب أن يكون عددًا صحيحًا.',
            'usage_count.min' => 'عدد مرات الاستخدام يجب أن يكون 1 على الأقل.',

            'expire_at.date' => 'تاريخ الانتهاء يجب أن يكون تاريخًا صالحًا.',
            'expire_at.after_or_equal' => 'تاريخ الانتهاء يجب أن يكون اليوم أو بعده.',
        ];
    }
}
