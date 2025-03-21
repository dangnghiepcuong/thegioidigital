<?php

namespace App\Services\ProductServices;

use App\Enums\ModelMetaKey;
use App\Models\Product;
use App\Repositories\Eloquents\ProductMetaRepository;
use App\Repositories\Eloquents\ProductRepository;
use Illuminate\Database\Eloquent\Collection;

class GenerateProductCardListViewService
{
    public function __construct(
        protected ProductRepository $productRepository,
        protected ProductMetaRepository $productMetaRepository,
        protected GenerateProductCardViewService $generateProductCardViewService,
        protected RenderProductCardViewWithDefaultVariantOptionService $renderProductCardViewWithDefaultVariantOptionService
    ) {
        //
    }


    public function __invoke(Collection $products, ?Collection $representVariants = null)
    {
        // render product card view with given product, represent variants foreach taxonomy term
        $htmlProductCardList = null;
        foreach ($products as $product) {
            $termsOfFirstPriorTaxonomy = self::getTermsByFirstPriorTaxonomyOfProduct($product);
            $representVariants = self::getRepresentativeVariants($product, $termsOfFirstPriorTaxonomy);
            $html = $this->renderProductCardViewWithDefaultVariantOptionService->__invoke(
                $product, $termsOfFirstPriorTaxonomy, $representVariants
            );
            $htmlProductCardList .= $html;
        }

        return $htmlProductCardList;
    }

    private function getTermsByFirstPriorTaxonomyOfProduct(Product $product): Collection
    {
        // get all terms of the first found prior taxonomy
        $termsOfFirstPriorTaxonomy = new Collection();
        foreach (ModelMetaKey::inPriorTaxonomies() as $priorTaxonomy) {
            $termsOfFirstPriorTaxonomy = $product->termTaxonomies()->where('taxonomy', $priorTaxonomy)->get();
            if ($termsOfFirstPriorTaxonomy->count()) {
                break;
            }
        }
        return $termsOfFirstPriorTaxonomy;
    }

    private function getRepresentativeVariants(Product $product, Collection $termTaxonomies): Collection
    {
        // get representative variant foreach given term
        $variants = new Collection();
        foreach ($termTaxonomies as $termTaxonomy) {
            $variant = $product->children()
                ->join('product_meta', 'product_meta.product_id', '=', 'products.id')
                ->where('product_meta.key', $termTaxonomy->taxonomy)
                ->where('product_meta.value', $termTaxonomy->term->name)
                ->select('products.*')
                ->first();
            $variants->push($variant);
        }

        return $variants;
    }
}
