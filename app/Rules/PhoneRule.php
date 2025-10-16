<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PhoneRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!preg_match('/^(?:\+7|8)\d{10}$/', $value)) {
            $fail(__('Введите корректный российский номер телефона.'));
        }
    }
}
