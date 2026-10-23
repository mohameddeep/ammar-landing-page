<?php

declare(strict_types=1);

namespace App\Http\Services\Website\Project;

use App\Repository\ProjectRepositoryInterface;
use App\Repository\StructureRepositoryInterface;
use App\Support\StructureContent;

final class ProjectService
{
    public function __construct(
        private readonly ProjectRepositoryInterface $projectRepository,
        private readonly StructureRepositoryInterface $structureRepository,
    ) {}

    public function index()
    {
        $projects = $this->projectRepository->getActiveForGallery();

        // Distinct categories (by shared key) for the gallery filter.
        $categories = $projects
            ->filter(fn ($project) => $project->categoryKey() !== null)
            ->unique(fn ($project) => $project->categoryKey())
            ->map(fn ($project) => ['key' => $project->categoryKey(), 'label' => $project->t('category')])
            ->values();

        $footerContent = StructureContent::decode($this->structureRepository->structure('footer'));

        return view('website.projects.index', compact('projects', 'categories', 'footerContent'));
    }

    public function show(string $slug)
    {
        $project = $this->projectRepository->findActiveBySlug($slug);
        abort_if($project === null, 404);

        $relatedProjects = $this->projectRepository->getRelated($project, 3);
        $footerContent = StructureContent::decode($this->structureRepository->structure('footer'));

        return view('website.projects.show', compact('project', 'relatedProjects', 'footerContent'));
    }
}
