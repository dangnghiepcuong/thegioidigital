<?php

namespace App\Services\ProductServices;

use App\Enums\ModelMetaKey;
use App\Models\Product;
use App\Models\ProductMeta;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GetProductCardViewByDataService
{
    public function __construct(
        protected GenerateProductCardViewService $generateProductCardViewService
    ) {}

    public function __invoke(Request $request)
    {
        try {
            DB::beginTransaction();
            $product = Product::newModelInstance($request->all());

            $productMeta = collect();
            foreach ($request->all() as $property => $value) {
                if (in_array($property, ModelMetaKey::inProductCardView()) && $value != null) {
                    if (in_array($property, ModelMetaKey::serializedData())) {
                        $value = serialize(explode("\r\n", $value));
                    }
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
