<?php

namespace App\Services\Service;

use App\Models\Service;
use App\Repositories\Service\ServiceRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ServiceService
{
    public function __construct(protected ServiceRepository $serviceRepository)
    {
    }

    public function list(int $perPage = 12): LengthAwarePaginator
    {
        return $this->serviceRepository->buildListQuery()->paginate($perPage);
    }

    public function show(Service $service): Service
    {
        return $this->serviceRepository->show($service);
    }
}
