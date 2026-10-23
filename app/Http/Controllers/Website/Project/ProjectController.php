<?php

declare(strict_types=1);

namespace App\Http\Controllers\Website\Project;

use App\Http\Controllers\Controller;
use App\Http\Services\Website\Project\ProjectService;

final class ProjectController extends Controller
{
    public function __construct(private readonly ProjectService $projectService) {}

    public function index()
    {
        return $this->projectService->index();
    }

    public function show(string $slug)
    {
        return $this->projectService->show($slug);
    }
}
