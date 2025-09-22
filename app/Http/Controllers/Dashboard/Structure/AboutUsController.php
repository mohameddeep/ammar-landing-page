<?php

namespace App\Http\Controllers\Dashboard\Structure;

use Illuminate\Http\Request;

final class AboutUsController extends StructureController
{
    protected string $contentKey = 'about';

    protected array $locales = ['en', 'ar'];

    public function store(Request $request)
    {
        return parent::_store($request);
    }
}
