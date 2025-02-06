<?php

namespace App\Repositories;

use App\Models\Service;
use App\Repositories\Contracts\ServiceRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ServiceRepository implements ServiceRepositoryInterface
{

    public function getAll(): Collection
    {
        return Service::all();
    }

    public function filterById(string $column, array $params): Collection
    {
        return Service::whereIn($column, $params)->get();
    }


}
