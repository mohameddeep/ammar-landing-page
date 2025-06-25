<?php

declare(strict_types=1);

namespace App\Repository;

interface CategoryRepositoryInterface extends RepositoryInterface
{

        public function getParentCategories();
}
