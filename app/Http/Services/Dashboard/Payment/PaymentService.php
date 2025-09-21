<?php

namespace App\Http\Services\Dashboard\Payment;

use App\Http\Services\Mutual\FileManagerService;
use App\Repository\PaymentRepositoryInterface;
use Illuminate\Support\Facades\DB;

class PaymentService
{
    public function __construct(private readonly PaymentRepositoryInterface $Repository,
                                private readonly FileManagerService $fileManagerService)
    {}


}