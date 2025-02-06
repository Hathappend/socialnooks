<?php

namespace App\Repositories;

use App\Models\Payment;
use App\Repositories\Contracts\PaymentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class PaymentRepository implements PaymentRepositoryInterface
{

    public function getAll(): Collection
    {
        return Payment::all();
    }

    public function filterById(string $column, array $params): Collection
    {
        return Payment::whereIn($column, $params)->get();
    }
}
