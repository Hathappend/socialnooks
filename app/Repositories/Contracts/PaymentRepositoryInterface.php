<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface PaymentRepositoryInterface
{
    public function getAll(): Collection;
}
