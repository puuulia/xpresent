<?php

namespace Database\Factories;

use App\Models\ServiceDuration;
use App\Models\ServiceScheduleItem;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ServiceScheduleItemFactory extends Factory
{
    protected $model = ServiceScheduleItem::class;

    public function definition(): array
    {
        return [
            'start_time' => Carbon::now(),
            'end_time' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'service_duration_id' => ServiceDuration::factory(),
        ];
    }
}
