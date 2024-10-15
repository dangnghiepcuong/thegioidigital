<?php

namespace App\Services\ProductServices;

use App\Repositories\Eloquents\ProductRepository;
use App\Repositories\Eloquents\TermTaxonomyRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class PageProductDetailService
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

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

        return view('product.index', [
            'product' => $product,
            'productMeta' => $product->productMeta,
            'productTermTaxonomies' => $product->termTaxonomies,
            'termTaxonomies' => $termTaxonomies,
            'sliderImages' => $product->getMedia('slider'),
        ]);
    }
}
