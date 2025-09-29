<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Home;

use App\Http\Controllers\Controller;
use App\Http\Services\Api\V1\Home\HomeService;

final class HomeController extends Controller
{
    public function __construct(private HomeService $homeService) {}

    public function index()
    {
        return $this->homeService->index();
    }

    public function HomeForProvider()
    {
        return $this->homeService->HomeForProvider();
    }
}
