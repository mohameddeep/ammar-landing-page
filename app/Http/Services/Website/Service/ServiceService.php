<?php

namespace App\Http\Services\Website\Service;

use App\Repository\ServiceRepositoryInterface;
use App\Support\StructureContent;
use App\Repository\StructureRepositoryInterface;

class ServiceService
{
    public function __construct(
        private readonly ServiceRepositoryInterface $serviceRepository,
        private readonly StructureRepositoryInterface $structureRepository,
    ) {}

    public function index()
    {
        // Fetch active services
        $services = $this->serviceRepository->getActive();

        $structures = $this->structureRepository->structuresForKeys(['service', 'footer']);
        $serviceContent = StructureContent::decode($structures['service'] ?? null);
        $footerContent = StructureContent::decode($structures['footer'] ?? null);

        return view('website.services.index', compact('services', 'serviceContent', 'footerContent'));
    }

    public function show($id)
    {
        // Fetch service by ID
        $service = $this->serviceRepository->getById($id);

        if (!$service || !$service->is_active) {
            abort(404);
        }

        $otherServices = $this->serviceRepository->getOtherActive($id, 3);

        $footerStructure = $this->structureRepository->structure('footer');
        $footerContent = StructureContent::decode($footerStructure);

        return view('website.services.show', compact('service', 'otherServices', 'footerContent'));
    }
}

