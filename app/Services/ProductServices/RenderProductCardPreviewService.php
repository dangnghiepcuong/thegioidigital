<?php

namespace App\Services\ProductServices;

use App\Enums\ModelMetaKey;
use App\Models\Product;
use App\Repositories\Eloquents\ProductMetaRepository;
use App\Repositories\Eloquents\ProductRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Blade;

class RenderProductCardPreviewService
{
    public function __construct(
        protected ProductRepository $productRepository,
        protected ProductMetaRepository $productMetaRepository
    ) {}

    /**
     * @param Product $product
     * @param ?Collection<Product> $variants
     * @param ?Product $parent
     */
    public function __invoke(Product $product, ?Collection $variants, ?Product $parent = null)
    {
        $htmlProductCard = null;

        // if there was no variant in the collection, return the product data
        if ($variants && !$variants->count() === 0) {
            $htmlProductCard .= view('components.product.card.index', [
                'product' => $product,
                'selectedVariantMeta' => $product->productMetaInCardView,
                'url' => route('products.dtdd.slug', $selectedVariant->slug ?? ''),
            ])->render();

            return $htmlProductCard;
        } else {
            $variants = $variants && $variants->count() === 0 ? collect() : $variants;
        }

        // if this $parent is not specified, this is a standalone product, it's parent itself
        $isParent = (bool) !$parent;
        $parent ??= $product;

        // get the first taxonomy in the prior list which this product has
        $selectedTermTaxonomy = null;
        foreach (ModelMetaKey::inPriorTaxonomies() as $priorTerm) {
            $selectedTermTaxonomy = $parent->termTaxonomies->where('taxonomy', $priorTerm)->first();
            if ($selectedTermTaxonomy) {
                break;
            }
        }

        // if this is a variant product, get the selected term taxonomy from its parent card
        // if the product is a standalone, there is no selected term taxonomy
        $selectedTermName = $isParent
            ? null
            : Arr::get($product->productMetaInCardViewByKey(Arr::get($selectedTermTaxonomy, 'taxonomy')), 'value');

        // get variants of the prior taxonomy
        $selectedTermTaxonomyVariants = collect();
        // for each difference term of the prior taxonomy
        foreach ($parent->termTaxonomies->where('taxonomy', Arr::get($selectedTermTaxonomy, 'taxonomy')) as $termTaxonomy) {
            // get the first variant which has this term taxonomy
            $variant = $variants
                ->filter(function ($productVariant) use ($termTaxonomy) {
                    return $productVariant->productMetaInCardView->where('value', $termTaxonomy->term->name)->count();
                })
                ->first();
            // add this representative variant to selected collect
            if ($variant) {
                $selectedTermTaxonomyVariants = $selectedTermTaxonomyVariants->concat([$variant]);
            }
        }

        // if the product is a standalone one,
        $selectedVariant = $isParent ? $selectedTermTaxonomyVariants->first() : $product;
        $selectedVariantMeta = $selectedVariant->productMetaInCardView ?? null;

        $htmlVariantOptionSelections = view('components.product.card.variant-option-selections', [
            'termTaxonomy' => Arr::get($selectedTermTaxonomy, 'taxonomy'),
            'termName' => $selectedTermName ?? Arr::get(Arr::get($selectedTermTaxonomy, 'term'), 'name'),
            'termTaxonomyVariants' => $selectedTermTaxonomyVariants,
        ])->render();

        $htmlProductCard .= Blade::render('<x-product.card.index
        :product="$product"
        :selectedVariantMeta="$selectedVariantMeta"
        :url="$url">
        '.$htmlVariantOptionSelections.'
        </x-product.card.index>', [
            'product' => $parent,
            'selectedVariantMeta' => $selectedVariantMeta,
            'url' => route('products.dtdd.slug', $selectedVariant->slug ?? ''),
        ]);

        return $htmlProductCard;
    }
}
