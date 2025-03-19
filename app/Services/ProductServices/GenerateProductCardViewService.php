<?php

namespace App\Services\ProductServices;

use App\Enums\ModelMetaKey;
use App\Models\Product;
use App\Repositories\Eloquents\ProductMetaRepository;
use App\Repositories\Eloquents\ProductRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

class GenerateProductCardViewService
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

        $isParent = (bool) !$parent;
        $parent ??= $product;

        $selectedTermTaxonomy = null;
        foreach (ModelMetaKey::inPriorTerms() as $priorTerm) {
            $selectedTermTaxonomy = $parent->termTaxonomies->where('taxonomy', $priorTerm)->first();
            if ($selectedTermTaxonomy) {
                break;
            }
        }

        $selectedTermName = $isParent
            ? null
            : Arr::get($product->productMetaInCardViewByKey(Arr::get($selectedTermTaxonomy, 'taxonomy')), 'value');

        $selectedTermTaxonomyVariants = collect();
        foreach ($parent->termTaxonomies->where('taxonomy', Arr::get($selectedTermTaxonomy, 'taxonomy')) as $termTaxonomy) {
            $variant = $variants
                ->filter(function ($productVariant) use ($termTaxonomy) {
                    return $productVariant->productMetaInCardView->where('value', $termTaxonomy->term->name)->count();
                })
                ->first();
            if ($variant) {
                $selectedTermTaxonomyVariants = $selectedTermTaxonomyVariants->concat([$variant]);
            }
        }

        $selectedVariant = $isParent ? $selectedTermTaxonomyVariants->first() : $product;
        $selectedVariantMeta = $selectedVariant->productMetaInCardView ?? null;

        $htmlVariantOptionSelections = view('components.product.card.variant-option-selections', [
            'termTaxonomy' => Arr::get($selectedTermTaxonomy, 'taxonomy'),
            'termName' => $selectedTermName ?? Arr::get(Arr::get($selectedTermTaxonomy, 'term'), 'name'),
            'termTaxonomyVariants' => $selectedTermTaxonomyVariants,
        ])->render();

        $htmlProductCard .= view('components.product.card.index', [
            'product' => $parent,
            'selectedVariantMeta' => $selectedVariantMeta,
            'url' => route('products.dtdd.slug', $selectedVariant->slug ?? ''),
            'slot' => $htmlVariantOptionSelections,
        ])->render();

        return $htmlProductCard;
    }
}
