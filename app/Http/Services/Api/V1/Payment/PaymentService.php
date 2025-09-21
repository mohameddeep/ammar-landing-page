<?php

namespace App\Http\Services\Api\V1\Payment;

use App\Repository\PaymentRepositoryInterface;

class PaymentService
{
    public function __construct(private PaymentRepositoryInterface $repository){}


}