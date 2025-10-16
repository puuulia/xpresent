<?php

namespace App\Console\Commands;

use App\Services\ServiceDuration\ServiceDurationService;
use Illuminate\Console\Command;

class ServiceScheduleFillNextDayCommand extends Command
{
    protected $signature = 'service-schedule:fill-next-day';

    protected $description = 'Create schedule';

    public function handle(ServiceDurationService $serviceDurationService): void
    {
        $serviceDurationService->generateTodayServiceDurationSchedule();
    }
}
