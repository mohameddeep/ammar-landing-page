<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Merchant;

use App\Http\Controllers\Controller;
use App\Http\Services\Api\V1\Merchant\MerchantService;

final class MerchantController extends Controller
{
    public function __construct(private MerchantService $merchantService) {}

    public function index()
    {
        return $this->merchantService->index();
    }

    public function show($id)
    {
        return $this->merchantService->show($id);
    }

}
