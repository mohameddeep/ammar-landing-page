<?php

declare(strict_types=1);

namespace App\Repository\Eloquent;

use App\Models\Slider;
use App\Repository\SliderRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

final class SliderRepository extends Repository implements SliderRepositoryInterface
{
    protected Model $model;

    public function __construct(Slider $model)
    {
        parent::__construct($model);
    }
}
