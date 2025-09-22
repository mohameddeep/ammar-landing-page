<?php

namespace App\Http\Controllers\Api\V1\Structure;

use App\Http\Resources\V1\Structure\AboutUsResource;

final class AboutUsController extends ApiStructureController
{
    protected string $contentKey = 'about';

    protected $resource = AboutUsResource::class;
}
