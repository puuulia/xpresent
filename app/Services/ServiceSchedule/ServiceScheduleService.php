<?php

namespace App\Services\ServiceSchedule;

use App\Models\ServiceDuration;
use App\Models\ServiceSchedule;
use App\Repositories\ServiceSchedule\ServiceScheduleRepository;
use App\Services\ServiceScheduleItem\ServiceScheduleItemService;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Collection;

class ServiceScheduleService
{
    public function __construct(
        protected ServiceScheduleItemService $serviceScheduleItemService,
        protected ServiceScheduleRepository $serviceScheduleRepository,
    )
    {
    }

    public function create(array $data): ServiceSchedule
    {
        return $this->serviceScheduleRepository->create($data);
    }

    public function generateSchedule(ServiceDuration $duration, Carbon $date): ServiceSchedule
    {
        if ($duration->serviceSchedules()->where('date', $date)->exists()) {
            $duration->serviceSchedules()->where('date', $date)->delete();
        }

        $schedule = $this->create([
            'service_duration_id' => $duration->id,
            'date' => $date,
        ]);

        $this->serviceScheduleItemService->generateItems($schedule);

        return $schedule;
    }

    public function generateScheduleToWeek(ServiceDuration $duration, ?iterable $dates = null): Collection
    {
        if (is_null($dates)) {
            $dates = CarbonPeriod::create(today(), '1 day', today()->addDays(6));
        }

        return Collection::make(
            collect($dates)->map(
                fn ($date) => $this->generateSchedule($duration, $date)
            )
        );
    }
}
