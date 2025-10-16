<?php

namespace Database\Seeders;

use App\Models\ServiceDuration;
use Illuminate\Database\Seeder;

class ServiceDurationSeeder extends Seeder
{
    public function run(): void
    {
        ServiceDuration::factory()->createMany([
            [
                'service_id' => 1,
                'duration' => 30,
            ],
            [
                'service_id' => 1,
                'duration' => 60,
            ],
            [
                'service_id' => 2,
                'duration' => 60,
            ],
            [
                'service_id' => 2,
                'duration' => 120,
            ],
        ]);
    }
}
