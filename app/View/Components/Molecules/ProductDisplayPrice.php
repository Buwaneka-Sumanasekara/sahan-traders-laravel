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
    public function __construct(public string $productId,public string $varientId)
    {
        $this->productId =$productId;
        $this->varientId=$varientId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
       // dd($this->varientId);
        
            $product = PmProduct::find($this->productId);
            return view('components.molecules.product-display-price', [
                'product' => $product,
                'varientId'=>$this->varientId,
            ]);
        
    }
}
