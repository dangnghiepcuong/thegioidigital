<?php

namespace App\Services\ProductServices;

use App\Repositories\Eloquents\ProductMetaRepository;
use App\Repositories\Eloquents\ProductRepository;
use App\Support\Traits\ProductTrait;
use Illuminate\Database\Eloquent\Collection;

class GenerateProductCardListViewService
{
    use ProductTrait;

    public function __construct(
        protected ProductRepository $productRepository,
        protected ProductMetaRepository $productMetaRepository,
        protected RenderProductCardViewWithDefaultVariantOptionService $renderProductCardViewWithDefaultVariantOptionService
    ) {
        //
    }

    /**
     *
     * Render product card view with given product, represent variants foreach taxonomy term
     * */
    public function __invoke(Collection $products, ?Collection $representVariants = null): string
    {
        $htmlProductCardList = null;
        foreach ($products as $product) {
            $termsOfFirstPriorTaxonomy = $this->getTermsByFirstPriorTaxonomyOfProduct($product);
            $representVariants = $this->getRepresentativeVariants($product, $termsOfFirstPriorTaxonomy);
            $html = $this->renderProductCardViewWithDefaultVariantOptionService->__invoke(
                $product, $termsOfFirstPriorTaxonomy, $representVariants
            );
            $htmlProductCardList .= $html;
        }

        return $htmlProductCardList;
    }
}
