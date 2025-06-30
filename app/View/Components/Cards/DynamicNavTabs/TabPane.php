<?php

declare(strict_types=1);

namespace App\View\Components\Cards\DynamicNavTabs;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class TabPane extends Component
{
    public string $id;

    public string $labelledby;

    public int $tabindex;

    public bool $active;

    public function __construct(
        string $id,
        string $labelledby,
        int $tabindex = 0,
        bool $active = false
    ) {
        $this->id = $id;
        $this->labelledby = $labelledby;
        $this->tabindex = $tabindex;
        $this->active = $active;
    }

    public function render(): View|Closure|string
    {
        return view('components.cards.dynamic-nav-tabs.tab-pane');
    }
}
