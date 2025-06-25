<?php

declare(strict_types=1);

namespace App\Repository\Eloquent;

use App\Models\Category;
use App\Repository\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

final class CategoryRepository extends Repository implements CategoryRepositoryInterface
{
    protected Model $model;

    public function __construct(Category $model)
    {
        parent::__construct($model);
    }



     public function getParentCategories()
    {
         $query = $this->model::query();  

    $query->when(request()->filled('search'), function ($q) {
        $search = request('search');
        $q->where(function ($q2) use ($search) {
            $q2->where('name_ar', 'like', '%' . $search . '%')
               ->orWhere('name_en', 'like', '%' . $search . '%')
               ->orWhere('slug', 'like', '%' . $search . '%');
        });
    });

    return $query
        ->whereNull('parent_id')
        ->where('is_active', true)
        ->latest()
        ->paginate(10);

    }

    
}
