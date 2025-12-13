<?php

namespace App\Http\Services\Dashboard\Home;
use Illuminate\Support\Facades\DB;

class HomeService
{
    public function __construct(
      
    ) {}



     public function home()
    {
        $statistics = [
            'services_count' => \App\Models\Service::count(),
            'sliders_count' => \App\Models\Slider::count(),
            'contacts_count' => \App\Models\ContactUs::count(),
        ];

        return view('dashboard.site.home.index', compact('statistics'));
    }

}
