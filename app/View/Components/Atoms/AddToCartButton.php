<?php

namespace App\View\Components\Atoms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AddToCartButton extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $productId,
        public string $stockBatchId,
        public bool $isInqItem,
        public float $qty = 1,
        public bool $isOutOfStock = false,
        public bool $isDisplayFullWidth = true

    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.atoms.add-to-cart-button');
    }
}
