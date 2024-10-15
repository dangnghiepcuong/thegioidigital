<?php

namespace App\Services\ProductServices;

use App\Repositories\Eloquents\TermTaxonomyRepository;

class PageCreateProductService
{

    public function __construct(
        protected TermTaxonomyRepository $termTaxonomyRepository
    ) {}

    public function __invoke()
    {
        $termTaxonomies = $this->termTaxonomyRepository->model()
            ->where('taxonomy', 'like', 'product_attr_%')
            ->get();

        return view('admin.products.create', [
            'termTaxonomies' => $termTaxonomies,
        ]);
    }
}
