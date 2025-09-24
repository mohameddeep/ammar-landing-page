<?php

namespace App\Repository;

interface SettingRepositoryInterface extends RepositoryInterface
{
    public function getSettings($key);
        public function getAllSettings();
        public function updateByKey(string $key, string $value);

}
