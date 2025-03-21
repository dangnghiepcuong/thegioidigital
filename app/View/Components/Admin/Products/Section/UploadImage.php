<?php

namespace App\View\Components\Admin\Products\Section;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;

class UploadImage extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        private int $productId,
        private MediaCollection $sliderImages
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.products.section.upload-image', [
            'productId' => $this->productId,
            'sliderImages' => $this->sliderImages,
        ]);
    }
}
