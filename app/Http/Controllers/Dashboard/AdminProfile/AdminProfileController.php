<?php

namespace App\Http\Controllers\Dashboard\AdminProfile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\AdminProfile\AdminProfileRequest;
use App\Http\Requests\Dashboard\Auth\UpdatePasswordRequest;
use App\Http\Requests\Dashboard\Settings\InfoSettingsRequest;
use App\Http\Services\Dashboard\AdminProfile\AdminProfileService;
use App\Repository\AdminProfileRepositoryInterface;


class AdminProfileController extends Controller
{
    private AdminProfileRepositoryInterface $adminProfileRepository;

    private AdminProfileService $adminProfileService;

    public function __construct(AdminProfileRepositoryInterface $adminProfileRepository, AdminProfileService $adminProfileService)
    {
        $this->adminProfileService = $adminProfileService;
        $this->adminProfileRepository = $adminProfileRepository;
    }

    public function edit(string $id)
    {
    
        $user = $this->adminProfileRepository->getById(auth()->id());

        return view('dashboard.site.admin-profile.edit', compact('user'));

    }

    public function update(AdminProfileRequest $request, string $id)
    {
        return $this->adminProfileService->update(auth()->id(), $request);
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        return $this->adminProfileService->updatePassword($request);
    }
}
