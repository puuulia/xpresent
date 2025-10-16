<?php

namespace Database\Factories;

use App\Models\Service;
use App\Models\ServiceDuration;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ServiceDurationFactory extends Factory
{
    protected $model = ServiceDuration::class;

    public function definition(): array
    {
        return [
            'duration' => $this->faker->randomNumber(),
            'service_id' => Service::query()->inRandomOrder()->value('id'),
        ];
    }
}
