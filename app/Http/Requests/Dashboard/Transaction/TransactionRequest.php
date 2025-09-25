<?php

namespace App\Http\Requests\Dashboard\Transaction;
use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // لو عايز تتحكم في الصلاحيات عدلها
    }

    public function rules(): array
    {
        return [
            'type'   => 'required|in:increase,decrease',
            'amount'  => 'required|numeric|min:1',
            'reason' => 'nullable|string|max:255',
        ];
    }
}
