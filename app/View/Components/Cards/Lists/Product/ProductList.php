<?php

namespace App\View\Components\Cards\Lists\Product;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProductList extends Component
{
    public $product;

    public function __construct($product)
    {
        $this->product = $product;
    }

    public function render(): View|Closure|string
    {
        return view('components.cards.lists.product.product-list');
    }
}
