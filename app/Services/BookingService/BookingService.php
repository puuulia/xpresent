<?php

namespace App\Services\BookingService;

use App\Models\Booking;
use App\Models\BookingItem;
use App\Models\ServiceScheduleItem;
use App\Repositories\Booking\BookingRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class BookingService
{
    public function __construct(protected BookingRepository $bookingRepository)
    {
    }

    /**
     * @param array $data
     * @return Booking
     */
    public function create(array $data): Booking
    {
        return DB::transaction(function () use ($data) {
            $scheduleItems = $this->validateBookingCreateData($data);

            $booking = $this->bookingRepository->create(
                collect($data)
                    ->only('user_name', 'comment', 'user_phone')
                    ->toArray()
            );

            $booking->bookingItems()->createMany(
                $scheduleItems->map(fn (ServiceScheduleItem $serviceScheduleItem) => [
                    'date' => $serviceScheduleItem->serviceSchedule->date,
                    'start_time' => $serviceScheduleItem->start_time,
                    'end_time' => $serviceScheduleItem->end_time,
                    'service_schedule_item_id' => $serviceScheduleItem->id,
                    'service_duration_id' => $serviceScheduleItem->serviceSchedule->service_duration_id,
                    'service_id' => $serviceScheduleItem->serviceSchedule->serviceDuration->service_id,
                    'booking_entity' => __(":serviceName на :time минут", [
                        'serviceName' => $serviceScheduleItem->serviceSchedule->serviceDuration->service->name,
                        'time' => $serviceScheduleItem->serviceSchedule->serviceDuration->duration
                    ])
                ])->toArray()
            );

            return $booking;
        });
    }

    public function validateBookingCreateData(array $data): Collection
    {
        $scheduleItems = ServiceScheduleItem::query()
            ->with(['serviceSchedule.serviceDuration.service', 'bookingItems'])
            ->whereIn('id', $data['serviceScheduleItems'])
            ->lockForUpdate()
            ->get();

        $userBookings = BookingItem::query()
            ->withWhereHas('booking', fn ($query) => $query->where('user_phone', $data['user_phone']))
            ->where(fn ($query) => $query
                ->whereIn('service_schedule_item_id', $data['serviceScheduleItems'])
                ->orWhere(fn ($query) => $scheduleItems->each(fn (ServiceScheduleItem $scheduleItem) =>
                    $query->orWhere(fn ($query) => $query
                        ->where('date', $scheduleItem->date)
                        ->where(fn ($query) => $query
                            ->whereBetween('start_time', [$scheduleItem->start_time, $scheduleItem->end_time])
                            ->orWhereBetween('end_time', [$scheduleItem->start_time, $scheduleItem->end_time])
                        )
                    )
                )))
            ->get();

        if ($userBookings->isNotEmpty()) {
            throw ValidationException::withMessages($userBookings->map(
                fn (BookingItem $bookingItem) => __(
                    'У Вас уже есть активные бронирования на :date с :start_time по :end_time.',
                    ['date' => $bookingItem->date, 'start_time' => $bookingItem->start_time, 'end_time' => $bookingItem->end_time]
                )
            )->toArray());
        }

        $scheduleItemsWithBookings = $scheduleItems->filter(
            fn (ServiceScheduleItem $serviceScheduleItem) => $serviceScheduleItem->bookingItems->isNotEmpty()
        );

        if ($scheduleItemsWithBookings->isNotEmpty()) {
            throw ValidationException::withMessages($scheduleItemsWithBookings->map(
                fn (ServiceScheduleItem $serviceScheduleItem) => __(
                    'Слот на :date в :time уже занят.',
                    [
                        'date' => $serviceScheduleItem->serviceSchedule->date->format('d.m.Y'),
                        'time' => $serviceScheduleItem->start_time,
                    ]
                )
            )->toArray());
        }

        $notEnabledScheduleItems = $scheduleItems->filter(
            fn (ServiceScheduleItem $serviceScheduleItem) => $serviceScheduleItem->enabled == false
        );

        if ($notEnabledScheduleItems->isNotEmpty()) {
            throw ValidationException::withMessages($notEnabledScheduleItems->map(
                fn (ServiceScheduleItem $serviceScheduleItem) => __(
                    'Слот на :date в :time недоступен для бронирования.',
                    [
                        'date' => $serviceScheduleItem->serviceSchedule->date->format('d.m.Y'),
                        'time' => $serviceScheduleItem->start_time,
                    ]
                )
            )->toArray());
        }

        return $scheduleItems;
    }
}
