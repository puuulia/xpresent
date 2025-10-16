<?php

namespace App\Repositories\ServiceSchedule;

use App\Models\ServiceSchedule;

class ServiceScheduleRepository
{
    public function create(array $data): ServiceSchedule
    {
        return ServiceSchedule::query()->create($data);
    }
}
