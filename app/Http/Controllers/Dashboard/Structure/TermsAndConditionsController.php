<?php

namespace App\Http\Controllers\Dashboard\Structure;

use App\Http\Requests\Dashboard\Structure\TermsAndConditionsRequest;
use Illuminate\Http\Request;

final class TermsAndConditionsController extends StructureController
{
    protected string $contentKey = 'terms_and_conditions';

    protected array $locales = ['en', 'ar'];

    public function store(Request $request)
    {
        return parent::_store($request);
    }
}
