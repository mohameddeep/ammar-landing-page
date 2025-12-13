<?php

namespace App\Http\Services\Website\LandingPage;

use App\Repository\LandingPageRepositoryInterface;
use App\Repository\StructureRepositoryInterface;

class LandingPageService
{
    

    public function __construct(
        private LandingPageRepositoryInterface $repository,
        private StructureRepositoryInterface $structureRepository,
    ) {}

    public function index()
    {
        // $header=$this->repository->getFirstByKey("header");
        // $chooseContent = $this->repository->getFirstByKey("content_one");
        // $features = $this->repository->getByKey("feature");
        // $expirenceContent = $this->repository->getFirstByKey("content_two");
        // $discovers = $this->repository->getByKey("discover");
        // $chooseContent = $this->repository->getFirstByKey("content_one");
        // $transform = $this->repository->getFirstByKey("ready_to_transform");
        // $footer = json_decode((string) $this->structureRepository->structure("footer")?->content, true);

        return view('website.landing-page.index',);
    }

    
}
