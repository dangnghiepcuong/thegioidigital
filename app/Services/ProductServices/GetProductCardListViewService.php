<?php

namespace App\Services\ProductServices;

use App\Repositories\Eloquents\ProductMetaRepository;
use App\Repositories\Eloquents\ProductRepository;
use App\Services\RenderProductViewServices\RenderProductCardOfDefaultVariantService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class GetProductCardListViewService
{
    public function __construct(
        protected ProductRepository $productRepository,
        protected ProductMetaRepository $productMetaRepository,
        protected RenderProductCardOfDefaultVariantService $renderProductCardViewOfDefaultVariantService
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
            $termsOfFirstPriorTaxonomy = $this->productRepository->getTermsByFirstPriorTaxonomyOfProduct($product);
            $representVariants = $this->productRepository->getRepresentativeVariants($product, $termsOfFirstPriorTaxonomy);
            $html = $this->renderProductCardViewOfDefaultVariantService->__invoke(
                $product, $termsOfFirstPriorTaxonomy, $representVariants
            );
            $htmlProductCardList .= $html;
        }

        return $htmlProductCardList;
    }
}
