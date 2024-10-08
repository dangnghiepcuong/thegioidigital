<?php

namespace App\View\Components\General\Popup\LocationSelect;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class index extends Component
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
        return view('components.general.popup.location-select.index')->with([
            'locations' => [
                0 => 'Hồ Chí Minh',
                1 => 'Bình Dương',
                2 => 'Đồng Nai',
                3 => 'Hà Nội',
                4 => 'Vĩnh Phúc',
                5 => 'Bến Tre',
            ]
        ]);
    }
}
