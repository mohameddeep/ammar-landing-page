<?php

namespace App\Http\Services\Dashboard\Packages;

use App\Http\Helpers\Http;
use App\Repository\PackageFeatureRepositoryInterface;

use function App\Http\Helpers\responseSuccess;

class PackageFeatureService
{
    public function __construct(
        private PackageFeatureRepositoryInterface $repository,
    ) {}
    public function toggle($request, $id)
    {
        $package = $this->repository->getById($id);

      
        $package->is_active = $request->input('is_active');
        $package->save();

        return responseSuccess(Http::OK, __('messages.updated_successfully'), [
            'success' => true,
            'is_active' => $package->is_active,
        ]);
    }
}
