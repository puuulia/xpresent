<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Resources\Service\ServiceResource;
use App\Models\Service;
use App\Services\Service\ServiceService;
use App\Services\ServiceScheduleItem\ServiceScheduleItemService;
use Inertia\Inertia;

class ServiceController extends Controller
{
    public function __construct(
        protected ServiceService $serviceService,
        protected ServiceScheduleItemService $serviceScheduleItemService,
    )
    {
    }

    public function index()
    {
        return Inertia::render('Services/List', [
            'services' => ServiceResource::collection($this->serviceService->list()),
        ]);
    }

    public function show(Service $service)
    {
        $service = $this->serviceService->show($service);

        return Inertia::render('Services/Show', [
            'service' => ServiceResource::make($service),
        ]);
    }
}
