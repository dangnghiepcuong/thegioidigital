<?php

namespace App\Services\ProductServices;

use App\Enums\ModelMetaKey;
use App\Enums\ProductStatusEnum;
use App\Repositories\Eloquents\ProductMetaRepository;
use App\Repositories\Eloquents\ProductRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ReplicateProductService
{
    public function __construct(
        protected ProductRepository $productRepository,
        protected ProductMetaRepository $productMetaRepository
    ) {}


    public function __invoke(Request $request, string $slug)
    {
        $slug = Str::slug($request->slug);
        $termTaxonomyIds = explode("\r\n", $request->term_taxonomy_ids);

        try {
            DB::beginTransaction();
            $product = $this->productRepository
                ->withoutGlobalScopes()
                ->where('slug', $slug)
                ->firstOrFail();
            $productMeta = $this->productMetaRepository->findByCondition(['product_id' => $product->id])->get();
            $termTaxonomyIds = $product->termTaxonomies()->pluck('term_taxonomies.id');

            $product->title = $product->title . ' ' . now();
            $product->slug = Str::slug($product->slug . '_' . now());
            $product->status = ProductStatusEnum::IN_PROCESS;

            $copyProduct = $this->productRepository
                ->withoutGlobalScopes()
                ->firstOrCreate($product->toArray());

            foreach ($productMeta as $meta) {
                $meta->product_id = $copyProduct->id;
                $copyMeta = $this->productMetaRepository->model()->firstOrCreate($meta->toArray());
            }

            $result = $copyProduct->termTaxonomies()->sync($termTaxonomyIds);

            DB::commit();
            return $copyProduct->slug;
        } catch (Exception $exception) {
            DB::rollBack();
            throw ($exception);
        }
    }
}
