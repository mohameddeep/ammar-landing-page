<?php

namespace App\Repository;

interface StructureRepositoryInterface extends RepositoryInterface
{
    public function structure($key);

    /**
     * Load several structure rows in one query (and one cache entry per epoch).
     *
     * @param  list<string>  $keys
     * @return array<string, \App\Models\Structure|null>
     */
    public function structuresForKeys(array $keys): array;

    public function publish($key, $content);
}
