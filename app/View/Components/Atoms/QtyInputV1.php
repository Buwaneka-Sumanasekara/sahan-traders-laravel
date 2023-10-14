<?php

namespace App\View\Components\Atoms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class QtyInputV1 extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public float $initialQty = 1,
        public float $minQty = 1,
        public float $maxQty = 10,
    ) {
        $this->initialQty = $initialQty;
        $this->minQty = $minQty;
        $this->maxQty = $maxQty;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.atoms.qty-input-v1', [
            'initialQty' => $this->initialQty,
            'minQty' => $this->minQty,
            'maxQty' => $this->maxQty,
        ]);
    }
}
