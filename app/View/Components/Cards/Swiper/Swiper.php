<?php

namespace App\View\Components\Cards\Swiper;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Swiper extends Component
{
    public $images;

    public function __construct($images)
    {
        $this->images = $images;
    }

    public function render(): View|Closure|string
    {
        return view('components.cards.swiper.swiper');
    }
}
