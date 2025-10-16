<?php

namespace App\Http\Resources\ServiceSchedule;

use App\Http\Resources\ServiceDuration\ServiceDurationResource;
use App\Http\Resources\ServiceScheduleItem\ServiceScheduleItemResource;
use App\Models\ServiceSchedule;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin ServiceSchedule */
class ServiceScheduleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'date' => $this->date,
            'service_duration_id' => $this->service_duration_id,
            'serviceDuration' => ServiceDurationResource::make($this->whenLoaded('serviceDuration')),
            'serviceScheduleItems' => ServiceScheduleItemResource::collection($this->whenLoaded('serviceScheduleItems')),
        ];
    }
}
