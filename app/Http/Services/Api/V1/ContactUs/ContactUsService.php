<?php

namespace App\Http\Services\Api\V1\ContactUs;
use App\Http\Traits\Responser;
use App\Http\Traits\FileManager;
use App\Repository\ContactUsRepositoryInterface;

use function App\Http\Helpers\responseFail;
use function App\Http\Helpers\responseSuccess;

class ContactUsService
{

    public function __construct(
        private ContactUsRepositoryInterface $repository,

    )
    {


    }

    public function contactUs($request)
    {
        try {
            $data = $request->validated();
            $this->repository->create($data);
            return responseSuccess(message:__('messages.created_successfully'));
        }catch (\Exception $e){
            return responseFail(message:$e->getMessage());
        }
    }
}

