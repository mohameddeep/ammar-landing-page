<?php

namespace App\Http\Controllers\Dashboard\Structure;

use Illuminate\Http\Request;

final class LandingPageFooterController extends StructureController
{
    protected string $contentKey = 'footer';

    protected array $locales = ['en', 'ar'];

    public function store(Request $request)
    {
        return parent::_store($request);
    }
}
