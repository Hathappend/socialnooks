<?php

namespace App\Services;

use App\Repositories\ServiceRepository;
use Illuminate\Database\Eloquent\Collection;

class ServiceService
{
    private ServiceRepository $serviceRepository;

    public function __construct(ServiceRepository $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    public function getServices(): Collection
    {
        return $this->serviceRepository->getAll();
    }

    public function filterColumn(string $column, array $value): Collection
    {
        return $this->serviceRepository->filterById($column, $value);
    }

}
