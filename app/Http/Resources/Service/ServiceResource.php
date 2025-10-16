<?php

namespace App\Http\Resources\Service;

use App\Http\Resources\ServiceDuration\ServiceDurationResource;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Service */
class ServiceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'images' => $this->images,
            'description' => $this->description,
            'serviceDurations' => ServiceDurationResource::collection($this->whenLoaded('serviceDurations')),
        ];
    }
}
