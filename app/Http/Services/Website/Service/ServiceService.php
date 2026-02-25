<?php

namespace App\Http\Services\Website\Service;

use App\Repository\ServiceRepositoryInterface;
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

        // Fetch Service structure content
        $serviceStructure = $this->structureRepository->structure('service');
        $serviceContent = null;
        if ($serviceStructure && $serviceStructure->content) {
            $serviceContent = json_decode($serviceStructure->content, true);
        }

        // Fetch Footer structure content
        $footerStructure = $this->structureRepository->structure('footer');
        $footerContent = null;
        if ($footerStructure && $footerStructure->content) {
            $footerContent = json_decode($footerStructure->content, true);
        }

        return view('website.services.index', compact('services', 'serviceContent', 'footerContent'));
    }

    public function show($id)
    {
        // Fetch service by ID
        $service = $this->serviceRepository->getById($id);

        if (!$service || !$service->is_active) {
            abort(404);
        }

        // Fetch other active services (for related services section)
        $otherServices = $this->serviceRepository->getActive()
            ->where('id', '!=', $id)
            ->take(3);

        // Fetch Footer structure content
        $footerStructure = $this->structureRepository->structure('footer');
        $footerContent = null;
        if ($footerStructure && $footerStructure->content) {
            $footerContent = json_decode($footerStructure->content, true);
        }

        return view('website.services.show', compact('service', 'otherServices', 'footerContent'));
    }
}

