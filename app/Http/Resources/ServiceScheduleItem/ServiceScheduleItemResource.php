<?php

namespace App\Http\Resources\ServiceScheduleItem;

use App\Http\Resources\ServiceSchedule\ServiceScheduleResource;
use App\Models\ServiceScheduleItem;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin ServiceScheduleItem */
class ServiceScheduleItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'enabled' => $this->enabled,
            'reason' => $this->reason,
            'service_schedule_id' => $this->service_schedule_id,
            'serviceSchedule' => ServiceScheduleResource::make($this->whenLoaded('serviceSchedule')),
            'disabled' => $this->disabled,
        ];
    }
}
