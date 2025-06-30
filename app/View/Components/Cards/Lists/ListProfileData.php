<?php

declare(strict_types=1);

namespace App\View\Components\Cards\Lists;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class ListProfileData extends Component
{
    public $title;

    public $recevedData;

    public $description;

    public $icon;

    public function __construct($title = null, $recevedData = null, $description = null, $icon = null)
    {
        $this->title = $title;
        $this->recevedData = $recevedData;
        $this->description = $description;
        $this->icon = $icon;
    }

    public function render(): View|Closure|string
    {
        return view('components.cards.lists.list-profile-data');
    }
}
