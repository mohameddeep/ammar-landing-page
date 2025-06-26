<?php

namespace App\View\Components\Buttons;

use Illuminate\View\Component;

class Toggle extends Component
{
    public $id;
    public $isActive;
    public $url;
    public $type;
    public $onText;
    public $offText;
    public $onClass;
    public $offClass;

    public function __construct($id, $isActive, $url, $type = 'button', $onText = '', $offText = '', $onClass = '', $offClass = '')
    {
        $this->id = $id;
        $this->isActive = (bool) $isActive;
        $this->url = $url;
        $this->type = $type;
        $this->onText = $onText;
        $this->offText = $offText;
        $this->onClass = $onClass;
        $this->offClass = $offClass;
    }

    public function render()
    {
        return view('components.buttons.toggle');
    }
}
