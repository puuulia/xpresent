<?php

namespace App\Services\ServiceDuration;

use App\Models\ServiceDuration;
use App\Repositories\ServiceDuration\ServiceDurationRepository;
use App\Services\ServiceSchedule\ServiceScheduleService;

class ServiceDurationService
{
    public function __construct(
        protected ServiceScheduleService $serviceScheduleService,
        protected ServiceDurationRepository $serviceDurationRepository
    )
    {
    }

    public function generateServiceDurationSchedule(ServiceDuration $serviceDuration, ?array $dates = null): void
    {
        $this->serviceScheduleService->generateScheduleToWeek($serviceDuration, $dates);
    }

    public function generateAllServiceDurationsSchedule(): void
    {
        $this->serviceDurationRepository
            ->buildListQuery()
            ->each(
                fn (ServiceDuration $serviceDuration) => $this->generateServiceDurationSchedule($serviceDuration)
            );
    }

    public function generateTodayServiceDurationSchedule(): void
    {
        $this->serviceDurationRepository
            ->buildListQuery()
            ->each(
                fn (ServiceDuration $serviceDuration) => $this->serviceScheduleService->generateSchedule($serviceDuration, today())
            );
    }
}
