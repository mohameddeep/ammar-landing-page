<?php

namespace App\Http\Controllers\Dashboard\Structure;

use Illuminate\Http\Request;

final class PolicyController extends StructureController
{
    protected string $contentKey = 'privacy_policy';

    protected array $locales = ['en', 'ar'];

    public function store(Request $request)
    {
        return parent::_store($request);
    }
}
