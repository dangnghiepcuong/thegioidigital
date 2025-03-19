<?php

namespace App\Services\ProductServices;

use App\Repositories\Eloquents\ProductRepository;
use App\Repositories\Eloquents\TermTaxonomyRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class GetVariantCardViewBySlugAndTermService
{
    public function __construct(
        protected ProductRepository $productRepository,
        protected TermTaxonomyRepository $termTaxonomyRepository,
        protected GenerateProductCardViewService $generateProductCardViewService
    ) {}

    public function __invoke(string $slug)
    {
        try {
            DB::beginTransaction();
            $product = $this->productRepository
                ->findByConditions(['slug' => $slug])
                ->with(['productMetaInCardView'])
                ->first();
            $siblings = $this->productRepository->findByConditions(['parent_id' => $product->parent_id])
                ->with(['productMetaInCardView'])
                ->get();
            $parent = $product->parent()->with(['termTaxonomies.term'])->first();

            DB::commit();

            $html = $this->generateProductCardViewService->__invoke($product, $siblings, $parent);

            return $html;
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }
}
