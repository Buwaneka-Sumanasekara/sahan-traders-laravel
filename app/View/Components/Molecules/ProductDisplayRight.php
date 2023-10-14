<?php

namespace App\View\Components\Molecules;

use App\Models\PmProduct;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProductDisplayRight extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public string $productId)
    {
        $this->productId = $productId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $product = PmProduct::find($this->productId);
        // dd($product);
        return view('components.molecules.product-display-right', [
            'product' => $product
        ]);
    }
}
