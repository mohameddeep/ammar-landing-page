<?php

declare(strict_types=1);

namespace App\Http\Services\Dashboard\PricingRequest;

use App\Enums\PricingRequestStatus;
use App\Http\Helpers\Http;
use App\Repository\PricingRequestRepositoryInterface;
use Illuminate\Support\Facades\Storage;

use function App\Http\Helpers\responseSuccess;

final class PricingRequestService
{
    public function __construct(
        private readonly PricingRequestRepositoryInterface $repository,
    ) {}

    public function index(?string $status)
    {
        $status = PricingRequestStatus::tryFrom((string) $status)?->value;
        $pricingRequests = $this->repository->paginateLatest($status);

        return view('dashboard.site.pricing-requests.index', compact('pricingRequests', 'status'));
    }

    public function show(string $id)
    {
        $pricingRequest = $this->repository->findWithTypes($id);

        return view('dashboard.site.pricing-requests.show', compact('pricingRequest'));
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function update(array $data, string $id)
    {
        $this->repository->update($id, $data);

        return redirect()->route('pricing-requests.show', $id)->with(['success' => __('messages.updated_successfully')]);
    }

    public function attachment(string $id)
    {
        $path = $this->repository->getById($id)->attachment;

        abort_unless($path && Storage::disk('local')->exists($path), 404);

        return Storage::disk('local')->download($path);
    }

    public function destroy(string $id)
    {
        $pricingRequest = $this->repository->getById($id);
        $path = $pricingRequest->attachment;

        $pricingRequest->delete();

        if ($path) {
            Storage::disk('local')->delete($path);
        }

        return responseSuccess(Http::OK, __('messages.deleted_successfully'), true);
    }
}
