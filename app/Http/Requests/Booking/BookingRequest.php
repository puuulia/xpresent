<?php

namespace App\Http\Requests\Booking;

use App\Rules\PhoneRule;
use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'serviceScheduleItems' => ['required', 'array', 'min:1', 'distinct'],
            'serviceScheduleItems.*' => ['required', 'integer', 'min:1'],
            'comment' => ['nullable', 'string', 'max:2047'],
            'user_name' => ['required', 'string', 'max:255'],
            'user_phone' => ['required', new PhoneRule()],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
