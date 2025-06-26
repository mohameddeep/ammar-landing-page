<?php

declare(strict_types=1);

namespace App\View\Components\Input;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class InputField extends Component
{
    public $attributes;

    public function __construct(
        public $name,
        public $type = 'text',
        public $label = '',
        public $placeholder = '',
        public $value = '',
        public $class = '',
        public $id = '',
        public $required = false,
        public $wrapperClass = 'col-md-6 mb-3',
        public $options = [],
        public $showName = 'title',
        public $readonly = false,
        public $disabled = false,
        $attributes = []
    ) {
        $this->attributes = $attributes;
    }

    public function render(): View|Closure|string
    {
        return view('components.input.input-field');
    }
}
