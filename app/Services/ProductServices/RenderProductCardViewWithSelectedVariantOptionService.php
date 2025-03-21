<?php

namespace App\Services\ProductServices;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Blade;

class RenderProductCardViewWithSelectedVariantOptionService
{
    public function __invoke(
        Product $selectedVariant,
        Collection $termsOfFirstPriorTaxonomy,
        Collection $representVariants,
        string $selectedTermTaxonomy,
    ): string
    {
        $defaultOption = $termsOfFirstPriorTaxonomy->first();
        $htmlVariantOptionBtn = view('components.product.card.variant-option-selections', [
                'termTaxonomy' => $defaultOption->taxonomy,
                'termName' => $selectedTermTaxonomy,
                'termTaxonomyVariants' => $representVariants,
            ])->render();

        $presentProduct = $selectedVariant;
        $presentMeta = $selectedVariant->productMetaInCardView;

        $htmlProductCardView = Blade::render('<x-product.card.index
        :product="$product"
        :selectedVariantMeta="$selectedVariantMeta"
        :url="$url">
        '.$htmlVariantOptionBtn.'
        </x-product.card.index>', [
            'product' => $presentProduct,
            'selectedVariantMeta' => $presentMeta ?? null,
            'url' => route('products.dtdd.slug', $presentProduct->slug ?? ''),
        ]);

        return $htmlProductCardView;
    }
}
