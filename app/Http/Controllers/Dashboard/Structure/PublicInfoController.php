<?php

namespace App\Http\Controllers\Dashboard\Structure;

use Illuminate\Http\Request;

final class PublicInfoController extends StructureController
{
    protected string $contentKey = 'public_info';

    protected array $locales = ['en', 'ar'];

    public function store(Request $request)
    {
        return parent::_store($request);
    }
}
