<?php

namespace Database\Seeders;

use App\Services\BookingService\BookingService;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    public function __construct(protected BookingService $bookingService)
    {
    }

    public function run(): void
    {
        $this->bookingService->create([
            'comment' => 'Тестовый комментарий',
            'user_name' => 'Имя человека',
            'user_phone' => '+71234567890',
            'serviceScheduleItems' => [
                4,
                7,
                11,
                12,
                14,
                19,
            ],
        ]);

        $this->bookingService->create([
            'comment' => 'Тестовый комментарий',
            'user_name' => 'Имя человека',
            'user_phone' => '+71234567891',
            'serviceScheduleItems' => [
                71,
            ],
        ]);

        $this->bookingService->create([
            'comment' => 'Тестовый комментарий',
            'user_name' => 'Имя человека',
            'user_phone' => '+71234567892',
            'serviceScheduleItems' => [
                120,
            ],
        ]);

        $this->bookingService->create([
            'comment' => 'Тестовый комментарий',
            'user_name' => 'Имя человека',
            'user_phone' => '+71234567890',
            'serviceScheduleItems' => [
                121,
                126,
                175,
            ],
        ]);
    }
}
