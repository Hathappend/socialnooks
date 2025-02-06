<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface ServiceRepositoryInterface
{
    public function getAll(): Collection;
}
