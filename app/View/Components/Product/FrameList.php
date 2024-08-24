<?php

namespace App\View\Components\Product\List;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FrameList extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $bannerLink,
        public string $backgroundColor,
        public string $productListComponent,
        public string $btnSeeMore,
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.product.list.frame-list', [
            'backgroundColor' => $backgroundColor ?? '',
        ]);
    }
}
