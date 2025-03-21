<?php

namespace App\View\Components\Admin\Products\Section;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Description extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        private ?string $description
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.products.section.description', [
            'description' => $this->description,
        ]);
    }
}
