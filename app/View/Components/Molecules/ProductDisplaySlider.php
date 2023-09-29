<?php

namespace App\View\Components\Molecules;

use App\Models\PmProductImages;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;


class ProductDisplaySlider extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $productId,
    ) {
        $this->productId = $productId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        $prodImages = PmProductImages::where("pm_product_id", $this->productId)->get();
        return view('components.molecules.product-display-slider', [
            'prodImages' => $prodImages
        ]);
    }
}
