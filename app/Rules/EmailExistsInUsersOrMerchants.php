<?php

namespace App\Rules;

use App\Models\User;
use App\Models\Merchant;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class EmailExistsInUsersOrMerchants implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $existsInUsers = User::where('email', $value)->exists();
        $existsInMerchants = Merchant::where('email', $value)->exists();

        if (!($existsInUsers || $existsInMerchants)) {
            $fail(__('validation.exists')); // Default error message for consistency
        }
    }
}
