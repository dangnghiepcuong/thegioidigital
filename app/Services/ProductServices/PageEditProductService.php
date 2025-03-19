<?php

namespace App\Services\ProductServices;

use App\Repositories\Eloquents\ProductRepository;
use App\Repositories\Eloquents\TermTaxonomyRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class PageEditProductService
{
    public function __construct(
        protected ProductRepository $productRepository,
        protected TermTaxonomyRepository $termTaxonomyRepository
    ) {}

    public function __invoke(string $slug)
    {
        try {
            DB::beginTransaction();
            $termTaxonomies = $this->termTaxonomyRepository->model()
                ->where('taxonomy', 'like', 'product_attr_%')
                ->get();

            $product = $this->productRepository->with(['productMeta', 'termTaxonomies'])
                ->withoutGlobalScopes()
                ->where('slug', $slug)
                ->firstOrFail();

            $variants = $this->productRepository->findByConditions(['parent_id' => $product->id])
                ->withoutGlobalScopes()
                ->with(['productMetaInCardView'])
                ->get();

            $siblings = $this->productRepository->findByConditions([
                ['parent_id', '=', $product->parent_id],
                ['parent_id', '!=', null],
                ['id', '!=', $product->id]
            ])->with(['productMetaInCardView'])
                ->withoutGlobalScopes()
                ->get();

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

        return view('admin.products.edit', [
            'product' => $product,
            'productMeta' => $product->productMeta,
            'productTermTaxonomies' => $product->termTaxonomies,
            'termTaxonomies' => $termTaxonomies,
            'variants' => $variants,
            'siblings' => $siblings,
            'sliderImages' => $product->getMedia('slider'),
        ]);
    }
}
