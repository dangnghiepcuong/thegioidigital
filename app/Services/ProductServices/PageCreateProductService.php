<?php

namespace App\Services\ProductServices;

use App\Repositories\Eloquents\ProductRepository;
use App\Repositories\Eloquents\TermTaxonomyRepository;

class PageCreateProductService
{

    public function __construct(
        protected TermTaxonomyRepository $termTaxonomyRepository,
        protected ProductRepository $productRepository
    )
    {
        //
    }

    public function __invoke()
    {
        $parentProducts = $this->productRepository->findByCondition(['parent_id' => null])->get();
        $termTaxonomies = $this->termTaxonomyRepository->model()
            ->where('taxonomy', 'like', 'product_attr_%')
            ->get();

        return view('admin.products.create', [
            'parentProducts' => $parentProducts,
            'termTaxonomies' => $termTaxonomies,
        ]);
    }
}
