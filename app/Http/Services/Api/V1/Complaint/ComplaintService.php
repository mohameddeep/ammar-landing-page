<?php

namespace App\Http\Services\Api\V1\Complaint;

use App\Repository\ComplaintRepositoryInterface;
use function App\Http\Helpers\responseFail;
use function App\Http\Helpers\responseSuccess;

class ComplaintService
{
    public function __construct(
        private ComplaintRepositoryInterface $repository,

    ) {}

    public function complaint($request)
    {
        try {
            $data = $request->validated();
            $this->repository->create($data);

            return responseSuccess(message: __('messages.created_successfully'));
        } catch (\Exception $e) {
            return responseFail(message: $e->getMessage());
        }
    }
}
