<?php

namespace App\View\Components\Admin\Products\Section;

use App\Models\Product;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\View\Component;

class MainInfo extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        private ?Product $product
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $title = Arr::get($this->product, 'title');
        $slug = Arr::get($this->product, 'slug');
        $type = Arr::get($this->product, 'type');
        $parentId = Arr::get($this->product, 'parent_id');
        $status = Arr::get($this->product, 'status');

        return view('components.admin.products.section.main-info', [
            'title' => $title,
            'slug' => $slug,
            'type' => $type,
            'parentId' => $parentId,
            'status' => $status,
        ]);
    }
}
