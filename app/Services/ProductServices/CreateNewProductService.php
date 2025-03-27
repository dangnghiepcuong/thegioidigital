<?php

namespace App\Services\ProductServices;

use App\Enums\ModelMetaKey;
use App\Http\Requests\CreateUpdateReplicateProductRequest;
use App\Repositories\Eloquents\ProductMetaRepository;
use App\Repositories\Eloquents\ProductRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CreateNewProductService
{
    public function __construct(
        protected ProductRepository $productRepository,
        protected ProductMetaRepository $productMetaRepository
    )
    {
        //
    }


    public function __invoke(CreateUpdateReplicateProductRequest $request)
    {
        $type = $request->type;
        $parentId = $request->parent_id;
        $status = $request->status;
        $title = $request->title;
        $slug = Str::slug($request->slug);
        $description = $request->description;
        $termTaxonomyIds = explode("\r\n", $request->term_taxonomy_ids);

        try {
            DB::beginTransaction();
            $product = $this->productRepository->model()->firstOrCreate([
                'type' => $type,
                'parent_id' => $parentId,
                'title' => $title,
                'slug' => $slug,
                'status' => $status,
                'description' => $description,
            ]);

            foreach ($request->all() as $key => $value) {
                if (!in_array($key, UpdateProductService::AUTO_FILLABLE_DATA)) {
                    continue;
                }

                $productMeta = $value ? $this->productMetaRepository->model()->firstOrCreate([
                    'key' => $key,
                    'value' => $request->str($key)->value(),
                    'product_id' => $product->id,
                ]) : null;
            }

            $result = !all_null_array($termTaxonomyIds) ? $product->termTaxonomies()->syncWithoutDetaching($termTaxonomyIds) : null;

            DB::commit();

            return $product->slug;
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }
}
