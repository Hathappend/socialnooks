<?php

namespace App\Services;

use App\Repositories\PaymentRepository;
use Illuminate\Database\Eloquent\Collection;

class PaymentService
{
    private PaymentRepository $paymentRepository;

    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function getPayments(): Collection
    {
        return $this->paymentRepository->getAll();
    }

    public function filterColumn(string $column, array $value): Collection
    {
        return $this->paymentRepository->filterById($column, $value);
    }
}
