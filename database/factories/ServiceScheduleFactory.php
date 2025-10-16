<?php

namespace Database\Factories;

use App\Models\ServiceDuration;
use App\Models\ServiceSchedule;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ServiceScheduleFactory extends Factory
{
    protected $model = ServiceSchedule::class;

    public function definition(): array
    {
        $duration = ServiceDuration::query()->inRandomOrder()->first();
        $startDate = new Carbon($this->faker->time());

        return [
            'date' => $this->faker->date(),
            'start_time' => $startDate,
            'end_time' => $startDate->addMinutes($duration->duration),
            'service_duration_id' => $duration->id,
        ];
    }
}
