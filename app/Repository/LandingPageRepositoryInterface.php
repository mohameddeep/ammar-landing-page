<?php

namespace App\Repository;

interface LandingPageRepositoryInterface extends RepositoryInterface {
    public function getByKey($key=null);
    public function getFirstByKey($key=null);

}
