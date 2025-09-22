<?php

namespace App\Http\Controllers\Api\V1\Structure;

use App\Http\Resources\V1\Structure\TermsAndConditionsResource;

final class TermsAndConditionsController extends ApiStructureController
{
    protected string $contentKey = 'terms_and_conditions';

    protected $resource = TermsAndConditionsResource::class;
}
