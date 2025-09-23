<?php

namespace App\Http\Services\Dashboard\Contact;

use App\Http\Helpers\Http;
use App\Repository\ContactUsRepositoryInterface;
use App\Repository\CouponRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;

use function App\Http\Helpers\responseFail;
use function App\Http\Helpers\responseSuccess;

class ContactService
{
    public function __construct(
        private readonly ContactUsRepositoryInterface $contactRepository,
    ) {}

    public function index()
    {
        $contacts = $this->contactRepository->paginate();

        return view('dashboard.site.contacts.index', compact('contacts'));
    }

 
    public function destroy($id)
    {
        try {
            $deleted = $this->contactRepository->delete($id);
            if ($deleted) {
                return responseSuccess(Http::OK, __('messages.deleted_successfully'), true);
            }

            return responseFail(Http::NOT_FOUND, __('messages.Not Found or Already Deleted'));

        } catch (Exception $e) {
            return responseFail(Http::BAD_REQUEST, ['error' => $e->getMessage(), __('messages.Something went wrong')]);
        }
    }
}
