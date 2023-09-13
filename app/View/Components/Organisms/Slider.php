<?php

namespace App\View\Components\Organisms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Slider extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view(
            'components.organisms.slider',
            ['sliders' => \App\Models\CdmSiteSliders::all()->where('active', true)]
        );
    }
}
