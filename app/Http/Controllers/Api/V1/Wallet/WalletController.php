<?php

namespace App\Http\Controllers\Api\V1\Wallet;

use App\Http\Controllers\Controller;
use App\Http\Services\Api\V1\Wallet\WalletService;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function __construct(private readonly WalletService $service)
    {

    }
    public function __invoke()
    {
        return $this->service->index();
    }
}
