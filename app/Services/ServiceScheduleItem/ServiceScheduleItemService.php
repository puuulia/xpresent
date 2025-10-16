<?php

namespace App\Services\ServiceScheduleItem;

use App\Models\ServiceSchedule;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Collection;

class ServiceScheduleItemService
{
    public const SCHEDULE_START_TIME = '10:00:00';
    public const SCHEDULE_END_TIME = '20:00:00';
    public const SCHEDULE_SERVICE_ADDITIONAL_MINUTES = 30;
    public const SCHEDULE_DISABLED_DAYS = [
        CarbonInterface::SUNDAY,
    ];

    public function __construct()
    {
    }

    public function generateItems(ServiceSchedule $serviceSchedule): Collection
    {
        return $serviceSchedule
            ->serviceScheduleItems()
            ->createMany(
                $this->generateScheduleItemsMap($serviceSchedule)
            );
    }

    public function generateScheduleItemsMap(ServiceSchedule $serviceSchedule): array
    {
        $serviceDuration = $serviceSchedule->serviceDuration->duration;
        $startScheduleTime = $this->getScheduleStartTime();
        $serviceAdditionalTime = $this->getScheduleServiceAdditionalMinutes();
        $slotTime = $serviceDuration + $serviceAdditionalTime;
        $endScheduleTime = $this->getScheduleEndTime()->subMinutes($serviceDuration);

        $slots = [];
        $startServiceTime = $startScheduleTime->copy();

        $enabled = !in_array($serviceSchedule->date->dayOfWeek, $this->getScheduleDisabledDays());

        while ($startServiceTime->lessThanOrEqualTo($endScheduleTime)) {
            $slots[] = [
                'start_time' => $startServiceTime->format('H:i'),
                'end_time' => $startServiceTime->copy()->addMinutes($serviceDuration)->format('H:i'),
                'enabled' => $enabled,
            ];

            $startServiceTime->addMinutes($slotTime);
        }

        return $slots;
    }

    public function getScheduleStartTime(): Carbon
    {
        return Carbon::parse(static::SCHEDULE_START_TIME);
    }

    public function getScheduleEndTime(): Carbon
    {
        return Carbon::parse(static::SCHEDULE_END_TIME);
    }

    public function getScheduleServiceAdditionalMinutes(): int
    {
        return static::SCHEDULE_SERVICE_ADDITIONAL_MINUTES;
    }

    public function getScheduleDisabledDays(): array
    {
        return static::SCHEDULE_DISABLED_DAYS;
    }
}
