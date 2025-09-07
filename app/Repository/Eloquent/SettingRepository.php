<?php

namespace App\Repository\Eloquent;

use App\Http\Traits\Responser;
use App\Models\Setting;
use App\Repository\SettingRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class SettingRepository extends Repository implements SettingRepositoryInterface
{
    protected Model $model;

    use Responser;

    public function __construct(Setting $model)
    {
        parent::__construct($model);
    }

    public function getSettings($key)
    {
        return $this->model->query()->where('key', $key)->first() ?? null;
    }

    public function getAllSettings()
    {
        return $this->model->query()->where('is_shown', 1)->get();
    }
}
