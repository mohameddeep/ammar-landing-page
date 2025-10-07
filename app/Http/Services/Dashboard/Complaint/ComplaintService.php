<?php

namespace App\Http\Services\Dashboard\Complaint;

use App\Http\Helpers\Http;
use App\Repository\ComplaintRepositoryInterface;
use Exception;

use function App\Http\Helpers\responseFail;
use function App\Http\Helpers\responseSuccess;

class ComplaintService
{
    public function __construct(
        private readonly ComplaintRepositoryInterface $complaintRepository,
    ) {}

    public function index()
    {
        $complaints = $this->complaintRepository->paginate();

        return view('dashboard.site.complaints.index', compact('complaints'));
    }

 
    public function destroy($id)
    {
        try {
            $deleted = $this->complaintRepository->delete($id);
            if ($deleted) {
                return responseSuccess(Http::OK, __('messages.deleted_successfully'), true);
            }

            return responseFail(Http::NOT_FOUND, __('messages.Not Found or Already Deleted'));

        } catch (Exception $e) {
            return responseFail(Http::BAD_REQUEST, ['error' => $e->getMessage(), __('messages.Something went wrong')]);
        }
    }
}
