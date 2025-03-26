<?php

namespace App\Services\ProductServices;

use App\Enums\ModelMetaKey;
use App\Models\Product;
use App\Models\ProductMeta;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GetProductCardPreviewService
{
    public function __construct(
        protected RenderProductCardPreviewService $renderProductCardPreviewService,
        protected RenderBadgeTemplateService      $renderBadgeTemplateService
    ) {
        //
    }

    public function __invoke(Request $request)
    {
        try {
            DB::beginTransaction();
            $product = Product::newModelInstance($request->all());

            $productMeta = new Collection();
            foreach ($request->all() as $property => $value) {
                if (in_array($property, ModelMetaKey::inProductCardView()) && $value != null) {
                    if (in_array($property, ModelMetaKey::serializedData())) {
                        $value = serialize(explode("\r\n", $value));
                    }
                    $meta = ProductMeta::newModelInstance(['key' => $property, 'value' => $value]);
                    $productMeta->push($meta);
                }
            }
            $badgeTemplate = $this->renderBadgeTemplateService->__invoke($request);
            $meta = ProductMeta::newModelInstance(['key' => ModelMetaKey::BADGE, 'value' => $badgeTemplate]);
            $productMeta->push($meta);

            $product->setRelation('productMetaInCardView', $productMeta);

            $html = $this->renderProductCardPreviewService->__invoke($product, null, $product);
            DB::commit();

            return $html;
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }
}
