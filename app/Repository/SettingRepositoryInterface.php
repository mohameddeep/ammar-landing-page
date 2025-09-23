<?php

namespace App\Repository;

interface SettingRepositoryInterface extends RepositoryInterface
{
    public function getSettings($key);
        public function getAllSettings();

}
