<?php

namespace App\Http\Resources\ServiceDuration;

use App\Http\Resources\Service\ServiceResource;
use App\Http\Resources\ServiceSchedule\ServiceScheduleResource;
use App\Models\ServiceDuration;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin ServiceDuration */
class ServiceDurationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'duration' => $this->duration,
            'service_id' => $this->service_id,
            'service' => ServiceResource::make($this->whenLoaded('service')),
            'serviceSchedules' => ServiceScheduleResource::collection($this->whenLoaded('serviceSchedules')),
            'futureServiceSchedules' => ServiceScheduleResource::collection($this->whenLoaded('futureServiceSchedules')),
        ];
    }
}
