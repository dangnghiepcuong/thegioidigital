<?php

namespace App\Services\ProductServices;

use App\Repositories\Eloquents\ProductRepository;
use App\Repositories\Eloquents\TermTaxonomyRepository;
use App\Services\RenderProductViewServices\RenderProductCardOfSelectedVariantService;
use App\Support\Traits\ProductTrait;

class LoadVariantCardViewService
{
    use ProductTrait;

    public function __construct(
        protected ProductRepository                             $productRepository,
        protected TermTaxonomyRepository                        $termTaxonomyRepository,
        protected RenderProductCardOfSelectedVariantService $renderProductCardViewOfSelectedVariantService
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
        $html = $this->renderProductCardViewOfSelectedVariantService->__invoke(
            $variant, $termsOfFirstPriorTaxonomy, $representVariants, $selectedTermTaxonomy
        );

        return $html;
    }
}
