<?php

declare(strict_types=1);

namespace App\View\Components\Cards\DynamicNavTabs;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class TabButton extends Component
{
    public string $id;

    public string $target;

    public string $label;

    public string $iconClass;

    public bool $active;

    public string $class;

    public function __construct(
        string $id,
        string $target,
        string $label,
        string $iconClass = '',
        bool $active = false,
        string $class = ''
    ) {
        $this->id = $id;
        $this->target = $target;
        $this->label = $label;
        $this->iconClass = $iconClass;
        $this->active = $active;
        $this->class = $class;
    }

    public function render(): View|Closure|string
    {
        return view('components.cards.dynamic-nav-tabs.tab-button');
    }
}
