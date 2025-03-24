<?php

namespace App\Services\ProductServices;

use App\Repositories\Eloquents\ProductRepository;
use App\Repositories\Eloquents\TermTaxonomyRepository;
use App\Support\Traits\ProductTrait;

class GetVariantCardViewBySlugService
{
    use ProductTrait;

    public function __construct(
        protected ProductRepository                                     $productRepository,
        protected TermTaxonomyRepository                                $termTaxonomyRepository,
        protected GenerateProductCardViewService                        $generateProductCardViewService,
        protected RenderProductCardViewWithSelectedVariantOptionService $renderProductCardViewWithSelectedVariantOptionService
    )
    {
        //
    }

    public function __invoke(string $slug)
    {
        $variant = $this->productRepository
            ->findByCondition(['slug' => $slug])
            ->with(['productMetaInCardView'])
            ->first();
        $parent = $variant->parent()->with(['termTaxonomies.term'])->first();
        $termsOfFirstPriorTaxonomy = $this->getTermsByFirstPriorTaxonomyOfProduct($parent);
        $representVariants = $this->getRepresentativeVariants($parent, $termsOfFirstPriorTaxonomy);
        $matchedMeta = $variant->productMetaInCardView->where('key', $termsOfFirstPriorTaxonomy->first()->taxonomy)->first();
        $selectedTermTaxonomy = $matchedMeta ? $matchedMeta->value : null;
        $html = $this->renderProductCardViewWithSelectedVariantOptionService
            ->__invoke($variant, $termsOfFirstPriorTaxonomy, $representVariants, $selectedTermTaxonomy);

        return $html;
    }
}
