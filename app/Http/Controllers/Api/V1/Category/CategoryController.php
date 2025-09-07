<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Category;

use App\Http\Controllers\Controller;
use App\Http\Services\Api\V1\Category\CategoryService;

final class CategoryController extends Controller
{
    public function __construct(private CategoryService $categoryService) {}

    public function index()
    {
        return $this->categoryService->index();
    }

    public function show($id)
    {
        return $this->categoryService->show($id);
    }
}
