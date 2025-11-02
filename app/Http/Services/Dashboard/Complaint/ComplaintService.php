<?php

namespace App\Http\Services\Dashboard\Complaint;

use App\Http\Helpers\Http;
use App\Http\Traits\SendNotification;
use App\Notifications\NewComplaintResponseNotification;
use App\Repository\ComplaintRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Log;

use function App\Http\Helpers\responseFail;
use function App\Http\Helpers\responseSuccess;

class ComplaintService
{
    use SendNotification;
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




    public function respond($request, $id)
    {
        $complaint = $this->complaintRepository->getById($id);

        if (!$complaint) {
            return responseFail(Http::NOT_FOUND, __('messages.Not Found or Already Deleted'));
        }

        // ✅ تحديث الرد في قاعدة البيانات
        $complaint->update([
            'response' => $request->response,
        ]);

        // ✅ إرسال إشعار قاعدة بيانات
        try {
            $complaint->user?->notify(new NewComplaintResponseNotification($complaint));
        } catch (\Exception $e) {
            Log::error('❌ Failed to send database notification: ' . $e->getMessage());
        }

        // ✅ إرسال إشعار عبر Firebase باستخدام trait
        try {
            $fcmToken = $complaint->user?->fcm_token;

            if (!empty($fcmToken)) {
                $notification = new NewComplaintResponseNotification($complaint);
                $firebaseData = $notification->firebaseData(); 

                // Call trait method directly
                $results = $this->sendFirebaseNotification(
                    [$fcmToken],
                    $firebaseData['title'] ?? __('messages.New Notification'),
                    $firebaseData['body'] ?? $complaint->response,
                    $firebaseData ?? []
                );

                Log::info('Firebase notification results: ', $results);
            }
        } catch (\Exception $e) {
            Log::error('❌ Failed to send Firebase notification: ' . $e->getMessage());
        }

        return redirect()->back()->with(['success' => __('messages.updated_successfully')]);
    }
}




