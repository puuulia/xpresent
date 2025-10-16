<?php

namespace Database\Seeders;

use App\Services\ServiceDuration\ServiceDurationService;
use Illuminate\Database\Seeder;

class ServiceScheduleSeeder extends Seeder
{
    public function __construct(protected ServiceDurationService $serviceDurationService)
    {
    }

    public function run(): void
    {
        $this->serviceDurationService->generateAllServiceDurationsSchedule();
    }
}
