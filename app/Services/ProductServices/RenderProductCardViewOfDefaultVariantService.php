<?php

namespace App\Services\ProductServices;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Blade;

class RenderProductCardViewOfDefaultVariantService
{
    public function __invoke(
        Product $product,
        Collection $termsOfFirstPriorTaxonomy,
        Collection $representVariants
    ): string
    {
        // if there is no taxonomy term & represent variant, this is a standalone product
        $isStandaloneProduct = $representVariants->count() === 0 && $termsOfFirstPriorTaxonomy->count() === 0;

        $defaultOption = $termsOfFirstPriorTaxonomy->first();
        $htmlVariantOptionBtn = $isStandaloneProduct ? null :
            view('components.product.card.variant-option-selections', [
            'termTaxonomy' => $defaultOption->taxonomy,
            'termName' => $defaultOption->term->name,
            'termTaxonomyVariants' => $representVariants,
        ])->render();

        // if this a standalone product, get its metadata, otherwise, get the represent variants metadata
        $presentProduct = $isStandaloneProduct ? $product : $representVariants->first();
        $presentMeta = $isStandaloneProduct ?
            $product->productMetaInCardView : $representVariants->first()->productMetaInCardView;

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
