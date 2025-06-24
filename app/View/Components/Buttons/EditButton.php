<?php

declare(strict_types=1);

namespace App\View\Components\Buttons;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class EditButton extends Component
{
    public string $route;

    public string $icon;

    public string $class;

    public string $tooltipColor;

    public string $tooltipTitle;

    public function __construct(
        string $route,
        string $icon = 'ri-pencil-line',
        string $class = 'btn btn-icon btn-outline-primary',
        string $tooltipColor = 'tooltip-primary',
        string $tooltipTitle = 'dashboard.Edit'
    ) {

        $this->route = $route;
        $this->icon = $icon;
        $this->class = $class;
        $this->tooltipColor = $tooltipColor;
        $this->tooltipTitle = __($tooltipTitle);
    }

    public function render(): View|Closure|string
    {
        return view('components.buttons.edit-button');
    }
}
