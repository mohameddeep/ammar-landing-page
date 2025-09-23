<?php

namespace App\Http\Services\Api\V1\Setting;

use App\Http\Resources\V1\Setting\SettingResource;
use App\Http\Services\Mutual\GetService;
use App\Http\Traits\Responser;
use App\Repository\SettingRepositoryInterface;
use Illuminate\Http\JsonResponse;

use function App\Http\Helpers\responseSuccess;

class SettingService
{
    use Responser;

    public function __construct(
        private readonly SettingRepositoryInterface $SettingRepository,
        private readonly GetService $getService
    ) {}




     public function index(): JsonResponse
    {

        $setting=$this->SettingRepository->getAllSettings();
        return responseSuccess(data:SettingResource::collection($setting));
    }

    // public function index(): JsonResponse
    // {
    //     return $this->responseSuccess(200, data: [
    //         'version' => $this->SettingRepository->getSettings('version')?->value,
    //         'android_url' => $this->SettingRepository->getSettings('android_url')?->value,
    //         'ios_url' => $this->SettingRepository->getSettings('ios_url')?->value,
    //     ]);
    // }

    public function settings_production(): JsonResponse
    {
        return $this->responseSuccess(200, data: [
            'APP_PRODUCTION_URL' => $this->SettingRepository->getSettings('APP_PRODUCTION_URL')?->value,
            'APP_TEST_URL' => $this->SettingRepository->getSettings('APP_TEST_URL')?->value,
            'IN_REVIEW' => boolval($this->SettingRepository->getSettings('IN_REVIEW')?->value),
            'IS_PRODUCTION' => boolval($this->SettingRepository->getSettings('IS_PRODUCTION')?->value
            ),
        ]);
    }
}
