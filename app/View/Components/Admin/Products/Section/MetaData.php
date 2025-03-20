<?php

namespace App\View\Components\Admin\Products\Section;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class MetaData extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        private ?Collection $productMeta
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.products.section.meta-data', [
            'productMeta' => $this->productMeta,
        ]);
    }
}
