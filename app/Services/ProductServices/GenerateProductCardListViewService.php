<?php

namespace App\Services\ProductServices;

use App\Repositories\Eloquents\ProductMetaRepository;
use App\Repositories\Eloquents\ProductRepository;
use Illuminate\Database\Eloquent\Collection;

class GenerateProductCardListViewService
{
    public function __construct(
        protected ProductRepository $productRepository,
        protected ProductMetaRepository $productMetaRepository,
        protected GenerateProductCardViewService $generateProductCardViewService
    ) {}


    public function __invoke(Collection $products, Collection $variants)
    {
        $htmlProductCardList = null;
        foreach ($products as $product) {
            $productVariants = $variants->where('parent_id', $product->id) ?? null;
            $html = $this->generateProductCardViewService->__invoke($product, $productVariants, null);
            $htmlProductCardList .= $html;
        }

        return $htmlProductCardList;
    }
}
