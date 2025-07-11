<?php

namespace App\Repositories\Eloquents;

use App\Enums\ModelMetaKey;
use App\Models\Product;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository extends BaseRepository
{
    public function model()
    {
        return new Product();
    }

    /**
     *
     * Get all terms of the first found prior taxonomy
     * */
    public function getTermsByFirstPriorTaxonomyOfProduct(Product $product): Collection
    {
        $termsOfFirstPriorTaxonomy = new Collection();
        foreach (ModelMetaKey::inPriorTaxonomies() as $priorTaxonomy) {
            $termsOfFirstPriorTaxonomy = $product->termTaxonomies()->where('taxonomy', $priorTaxonomy)->get();
            if ($termsOfFirstPriorTaxonomy->count()) {
                break;
            }
        }
        return $termsOfFirstPriorTaxonomy;
    }

    /**
     *
     * Get representative variant foreach given term
     * */
    public function getRepresentativeVariants(Product $product, Collection $termTaxonomies): Collection
    {
        $variants = new Collection();
        foreach ($termTaxonomies as $termTaxonomy) {
            $variant = $product->children()
                ->join('product_meta', 'product_meta.product_id', '=', 'products.id')
                ->where('product_meta.key', $termTaxonomy->taxonomy)
                ->where('product_meta.value', $termTaxonomy->term->name)
                ->select('products.*')
                ->first();
            $variant ? $variants->push($variant) : null;
        }

        return $variants;
    }
}
