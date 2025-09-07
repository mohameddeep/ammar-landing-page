<?php

declare(strict_types=1);

namespace App\View\Components\Buttons;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class ShowButton extends Component
{
    public string $route;

    public string $icon;

    public string $class;

    public string $tooltipColor;

    public string $tooltipTitle;

    public function __construct(
        string $route,
        string $icon = 'ri-eye-line',
        string $class = 'btn btn-icon btn-outline-info',
        string $tooltipColor = 'tooltip-info',
        string $tooltipTitle = 'dashboard.show'
    ) {

        $this->route = $route;
        $this->icon = $icon;
        $this->class = $class;
        $this->tooltipColor = $tooltipColor;
        $this->tooltipTitle = __($tooltipTitle);
    }

    public function render(): View|Closure|string
    {
        return view('components.buttons.show-button');
    }
}
