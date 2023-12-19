<?php

namespace App\View\Components\Molecules;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use  Illuminate\Database\Eloquent\Collection;

class ProductDisplayVarients extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public Collection $arVarients,public int $selectedVarient)
    {
        $this->arVarients = $arVarients;
        $this->selectedVarient = $selectedVarient;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.molecules.product-display-varients',[
            $arVarient=$this->arVarients,
            $selectedVarient=$this->selectedVarient
        ]);
    }
}
