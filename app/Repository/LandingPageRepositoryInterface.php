<?php

namespace App\Repository;

interface LandingPageRepositoryInterface extends RepositoryInterface
{
    public function getFirstByKey(string $key);

    public function getByKey(string $key);
}

