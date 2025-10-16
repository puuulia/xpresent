<?php

namespace App\Http\Resources\Booking;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Booking */
class BookingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'comment' => $this->comment,
            'user_name' => $this->user_name,
            'phone' => $this->user_phone,
        ];
    }
}
