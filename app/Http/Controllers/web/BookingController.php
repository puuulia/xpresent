<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Booking\BookingRequest;
use App\Services\BookingService\BookingService;

class BookingController extends Controller
{
    public function __construct(protected BookingService $bookingService)
    {
    }

    public function store(BookingRequest $request)
    {
        $this->bookingService->create($request->validated());

        return redirect()->route('services.index')
            ->with('success', __('Бронирование успешно создано.'));
    }
}
