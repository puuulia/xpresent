<?php

namespace App\Repositories\ServiceDuration;

use App\Models\ServiceDuration;

class ServiceDurationRepository
{
    public function buildListQuery($builder = null)
    {
        if (is_null($builder)) {
            $builder = ServiceDuration::query();
        }

        return $builder;
    }
}
