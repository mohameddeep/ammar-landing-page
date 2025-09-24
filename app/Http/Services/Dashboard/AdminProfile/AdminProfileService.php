<?php

namespace App\Http\Services\Dashboard\AdminProfile;

use App\Http\Traits\FileTrait;
use App\Repository\AdminProfileRepositoryInterface;
use App\Repository\ManagerRepositoryInterface;
use Illuminate\Support\Facades\DB;

use function App\Http\Helpers\update_model;

class AdminProfileService
{
    use FileTrait;

    public function __construct(
        private readonly AdminProfileRepositoryInterface $adminProfileRepository,
        private ManagerRepositoryInterface $repository,
    ) {}

    public function update($id, $request)
    {

        $data = $request->validated();

        $manager = $this->repository->getById($id);

        if ($request->hasFile('image')) {
            $data['image'] = $this->image($request->file('image'), 'profiles/members/images', $manager->image);
        }
        // if ($request->image !== null) {

        //     $data['image'] = $this->fileManagerService->handle('image', 'profiles/members/images');
        // }
        update_model($this->adminProfileRepository, $id, $data, '');

        return redirect()->back()->with(['success' => __('messages.updated_successfully')]);
    }

    public function updatePassword($request)
    {
        DB::beginTransaction();
        try {
            update_model($this->adminProfileRepository, auth()->id(), ['password' => $request->new_password]);
            DB::commit();

            return redirect()->back()->with(['success' => __('messages.updated_successfully')]);
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }
}
