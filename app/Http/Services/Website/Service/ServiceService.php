<?php

namespace App\Http\Services\Website\Service;

use App\Repository\ServiceRepositoryInterface;
use App\Repository\StructureRepositoryInterface;
use App\Support\StructureContent;

class ServiceService
{
    public function __construct(
        private readonly ServiceRepositoryInterface $serviceRepository,
        private readonly StructureRepositoryInterface $structureRepository,
    ) {}

    public function index()
    {
        // Top-level services; parents carry their active children for the hover list
        $services = $this->serviceRepository->getActiveTopLevelWithChildren();

        $structures = $this->structureRepository->structuresForKeys(['service', 'footer']);
        $serviceContent = StructureContent::decode($structures['service'] ?? null);
        $footerContent = StructureContent::decode($structures['footer'] ?? null);

        return view('website.services.index', compact('services', 'serviceContent', 'footerContent'));
    }

    public function show($id)
    {
        // Fetch service by ID
        $service = $this->serviceRepository->getById($id);

        if (! $service || ! $service->is_active) {
            abort(404);
        }

        $service->load(['parent', 'activeChildren']);

        // A child shows its siblings; a top-level service shows other top-level services.
        $otherServices = $service->parent_id
            ? $this->serviceRepository->getOtherActive($id, 3, $service->parent_id)
            : $this->serviceRepository->getActiveTopLevelWithChildren()->where('id', '!=', $service->id)->take(3)->values();

        $footerStructure = $this->structureRepository->structure('footer');
        $footerContent = StructureContent::decode($footerStructure);

        return view('website.services.show', compact('service', 'otherServices', 'footerContent'));
    }
}
