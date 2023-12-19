<?php

namespace App\View\Components\Molecules;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\PmProduct;

class ProductDisplayPrice extends Component
{
     /**
     * Create a new component instance.
     */
    public function __construct(public PmProduct $product,public string $varientId)
    {
        $this->product =$product;
        $this->varientId=$varientId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
         
            return view('components.molecules.product-display-price', [
                'product' => $this->product,
                'varientId'=>$this->varientId,
            ]);
        
    }
}
