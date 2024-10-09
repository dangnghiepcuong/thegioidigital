<?php

namespace App\Services\ProductServices;

use App\Repositories\Eloquents\TermTaxonomyRepository;

class CreatePageProductService
{
    protected TermTaxonomyRepository $termTaxonomyRepository;

    public function __construct(
        TermTaxonomyRepository $termTaxonomyRepository
    ) {
        $this->termTaxonomyRepository = $termTaxonomyRepository;
    }

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
