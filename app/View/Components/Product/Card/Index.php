<?php

namespace App\View\Components\Product\Card;

use App\Models\Product;
use App\Models\ProductMeta;
use App\Models\TermTaxonomy;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\View\Component;

class Index extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public ?Product $product,
        public ?SupportCollection $productVariants,
        public ?TermTaxonomy $selectedTermTaxonomy,
        public ?Collection $selectedVariantMeta,
        public ?string $url
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.product.card.index');
    }
}
