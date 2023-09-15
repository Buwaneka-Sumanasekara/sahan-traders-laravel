<?php

namespace App\View\Components\organisms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Header extends Component
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

        $user = session()->get('user');
        $user_role = $user ? ($user->um_user_role_id === config("global.user_role_admin")) : "";

        return view('components.organisms.header', [
            'has_user' => ($user ? true : false),
            'user' => $user,
            'is_admin' => $user_role,
            'cart_count' => 0
        ]);
    }
}
