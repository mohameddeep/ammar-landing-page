<?php

namespace App\Repository;

use App\Models\Project;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface ProjectRepositoryInterface extends RepositoryInterface
{
    /** Active projects for the public gallery, featured first then by sort order. */
    public function getActiveForGallery(): Collection;

    /** One active project by slug with its gallery images, or null. */
    public function findActiveBySlug(string $slug): ?Project;

    /** Other active projects, same category first. */
    public function getRelated(Project $project, int $limit = 3): Collection;

    /** Dashboard listing with gallery image counts. */
    public function paginateForDashboard(int $perPage = 10): LengthAwarePaginator;
}
