<?php

namespace App\Http\Services\Api\V1\Complaint;

use App\Http\Resources\V1\Complaint\ComplaintResource;
use App\Notifications\NewComplaintNotification;
use App\Repository\ComplaintRepositoryInterface;
use App\Repository\ManagerRepositoryInterface;
use Illuminate\Support\Facades\Log;

use function App\Http\Helpers\paginatedJsonResponse;
use function App\Http\Helpers\responseFail;
use function App\Http\Helpers\responseSuccess;

class ComplaintService
{
    public function __construct(
        private ComplaintRepositoryInterface $repository,
        private ManagerRepositoryInterface $managerRepository,

    ) {}


 public function index()
    {
  $user = auth()->user();

    $complaints = $this->repository->paginateWithQuery(function ($query) use ($user) {
        $query->where('user_id', $user->id);
    });
        return paginatedJsonResponse( data: ['items' => ComplaintResource::collection($complaints)]);

    }

    public function store($request)
    {
        try {
            $data = $request->validated();
            $data["user_id"]=auth()->user()->id;
            $complaint = $this->repository->create($data);
            $this->sendNotificationToAdmins(
            title: __('messages.new_complaint_title'),
            body: __('messages.new_complaint_body', ['name' => auth()->user()->name]),
            data: [
                    'complaint_id' => $complaint->id,
                    'user_id' => $complaint->user_id,
                    'type' => "complaint_response",
                    ]
);


            return responseSuccess(message: __('messages.created_successfully'));
        } catch (\Exception $e) {
            return responseFail(message: $e->getMessage());
        }
    }


    public function sendNotificationToAdmins($title, $body, $data = [])
    {
        try {
            $admins = $this->managerRepository->getAll();

            foreach ($admins as $admin) {
                $admin->notify(new NewComplaintNotification($title, $body, $data));
            }
        } catch (\Exception $e) {
            Log::error('Notification sending failed: ' . $e->getMessage());
        }
    }
}
