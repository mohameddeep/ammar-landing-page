<?php

namespace App\Rules;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class EmailExistsInUsers implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $existsInUsers = User::where('email', $value)->exists();

        if (! ($existsInUsers)) {
            $fail(__('validation.exists')); // Default error message for consistency
        }
    }
}
