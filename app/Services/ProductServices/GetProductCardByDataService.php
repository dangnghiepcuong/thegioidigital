<?php

namespace App\Services\ProductServices;

use App\Enums\ModelMetaKey;
use App\Http\Requests\CreateUpdateReplicateProductRequest;
use App\Models\Product;
use App\Models\ProductMeta;
use Exception;
use Illuminate\Support\Facades\DB;

class GetProductCardByDataService
{
    public function __construct(
        protected GenerateProductCardViewService $generateProductCardViewService
    ) {}

    public function __invoke(CreateUpdateReplicateProductRequest $request)
    {
        try {
            DB::beginTransaction();
            $product = Product::newModelInstance($request->all());

            $productMeta = collect();
            foreach ($request->all() as $property => $value) {
                if (in_array($property, ModelMetaKey::inProductCardView()) && $value != null) {
                    $meta = ProductMeta::newModelInstance(['key' => $property, 'value' => $value]);
                    $productMeta->push($meta);
                }
            }
            $product->setRelation('productMetaInCardView', $productMeta);
            $html = $this->generateProductCardViewService->__invoke($product, null, $product);
            DB::commit();

            return $html;
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }
}
