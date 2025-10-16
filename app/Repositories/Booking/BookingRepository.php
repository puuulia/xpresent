<?php

namespace App\Repositories\Booking;

use App\Models\Booking;

class BookingRepository
{
    public function create(array $data): Booking
    {
        return Booking::query()->create($data);
    }
}
