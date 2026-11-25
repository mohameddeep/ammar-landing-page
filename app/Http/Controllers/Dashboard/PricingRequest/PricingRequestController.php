<?php

declare(strict_types=1);

namespace App\Http\Controllers\Dashboard\PricingRequest;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\PricingRequest\UpdatePricingRequestRequest;
use App\Http\Services\Dashboard\PricingRequest\PricingRequestService;
use Illuminate\Http\Request;

final class PricingRequestController extends Controller
{
    public function __construct(private readonly PricingRequestService $service) {}

    public function index(Request $request)
    {
        return $this->service->index($request->string('status')->toString());
    }

    public function show(string $id)
    {
        return $this->service->show($id);
    }

    public function update(UpdatePricingRequestRequest $request, string $id)
    {
        return $this->service->update($request->validated(), $id);
    }

    public function attachment(string $id)
    {
        return $this->service->attachment($id);
    }

    public function destroy(string $id)
    {
        return $this->service->destroy($id);
    }
}
