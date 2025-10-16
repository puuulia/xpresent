<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\ServiceDuration;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    protected $model = Booking::class;

    public function definition(): array
    {
        return [
            'date' => $this->faker->dateTime(),
            'comment' => $this->faker->text(),
            'user_name' => $this->faker->userName(),
            'phone' => $this->faker->phoneNumber(),
            'user_id' => User::query()->inRandomOrder()->value('id'),
            'service_duration_id' => ServiceDuration::query()->inRandomOrder()->value('id'),
        ];
    }
}
