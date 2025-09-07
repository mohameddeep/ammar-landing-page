<?php

declare(strict_types=1);

namespace App\Repository;

interface PackageFeatureRepositoryInterface extends RepositoryInterface
{
    public function deleteBy(array $conditions);
}
