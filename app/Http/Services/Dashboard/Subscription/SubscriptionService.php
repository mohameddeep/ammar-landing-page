<?php

namespace App\Http\Services\Dashboard\Subscription;

use App\Http\Helpers\Http;
use App\Repository\SubscriptionRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;

use function App\Http\Helpers\responseFail;
use function App\Http\Helpers\responseSuccess;

class SubscriptionService
{
    public function __construct(
        private readonly SubscriptionRepositoryInterface $subscriptionRepository,
    ) {}

    public function index()
    {
        $subscriptions = $this->subscriptionRepository->paginate(relations:["user", "package"]);

        return view('dashboard.site.subscriptions.index', compact('subscriptions'));
    }



    public function destroy($id)
    {
        try {
            $deleted = $this->subscriptionRepository->delete($id);
            if ($deleted) {
                return responseSuccess(Http::OK, __('messages.deleted_successfully'), true);
            }

            return responseFail(Http::NOT_FOUND, __('messages.Not Found or Already Deleted'));

        } catch (Exception $e) {
            return responseFail(Http::BAD_REQUEST, ['error' => $e->getMessage(), __('messages.Something went wrong')]);
        }
    }
    public function toggle($id)
    {
        $subscription = $this->subscriptionRepository->getById($id);
        $subscription->is_active = ! $subscription->is_active;
        $subscription->save();

        return responseSuccess(Http::OK, __('messages.updated_successfully'), ['success' => true, 'is_active' => $subscription->is_active]);
    }

}
