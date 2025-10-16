<?php

namespace App\Repositories\Service;

use App\Models\Service;

class ServiceRepository
{
    public function buildListQuery($builder = null)
    {
        if (is_null($builder)) {
            $builder = Service::query();
        }

        return $builder;
    }

    public function show(Service $service): Service
    {
        return $service->loadMissing('serviceDurations.futureServiceSchedules.serviceScheduleItems.bookingItems', 'serviceDurations.futureServiceSchedules.serviceScheduleItems.serviceSchedule');
    }
}
