<?php

declare(strict_types=1);

namespace App\Http\Services\Website\PricingRequest;

use App\Enums\PricingRequestStatus;
use App\Repository\PricingRequestRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Throwable;

final class PricingRequestService
{
    public function __construct(
        private readonly PricingRequestRepositoryInterface $repository,
    ) {}

    /**
     * @param  array<string, mixed>  $data  validated form data
     */
    public function store(array $data, ?UploadedFile $attachment = null): RedirectResponse
    {
        $path = null;

        try {
            // Private disk: attachments are only downloadable from the dashboard.
            $path = $attachment?->store('pricing-quotes', 'local') ?: null;

            DB::transaction(function () use ($data, $path): void {
                $pricingRequest = $this->repository->create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'project_space' => $data['project_space'],
                    'city' => $data['city'],
                    'notes' => $data['notes'] ?? null,
                    'attachment' => $path,
                    'locale' => app()->getLocale(),
                    'status' => PricingRequestStatus::New->value,
                ]);

                $pricingRequest->projectTypes()->sync($data['project_types']);
            });

            return back()->with('success', __('website.pricingQuoteSuccess'));
        } catch (Throwable $e) {
            report($e);

            if ($path) {
                Storage::disk('local')->delete($path);
            }

            return back()->with('error', __('website.contactErrorMessage'))->withInput();
        }
    }
}
