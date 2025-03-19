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
    protected $autoFillData = [
        ModelMetaKey::THUMB_URL,
        ModelMetaKey::BOTTOM_LEFT_STAMP_URL,
        ModelMetaKey::REGULAR_PRICE,
        ModelMetaKey::PRICE,
        ModelMetaKey::GIFT,
        ModelMetaKey::RAM,
        ModelMetaKey::ROM,
        ModelMetaKey::STORAGE,
        ModelMetaKey::COLOR,
        ModelMetaKey::SCREEN_SIZE,
        ModelMetaKey::SCREEN_RESOLUTION,
        ModelMetaKey::SCREEN_MATERIAL,
        ModelMetaKey::BACK_CAMERA,
        ModelMetaKey::FRONT_CAMERA,
        ModelMetaKey::BATTERY,
        ModelMetaKey::CHARGE_POWER,
        ModelMetaKey::CPU,
        ModelMetaKey::MEMORY,
        ModelMetaKey::BRAND,
    ];

    public function __construct(
        protected ProductRepository $productRepository,
        protected ProductMetaRepository $productMetaRepository
    ) {}


    public function __invoke(CreateUpdateReplicateProductRequest $request)
    {
        $type = $request->type;
        $parentId = $request->parent_id;
        $status = $request->status;
        $topTags = explode("\r\n", $request->str(ModelMetaKey::TOP_TAGS)->value());
        $compareTags = explode("\r\n", $request->str(ModelMetaKey::COMPARE_TAGS)->value());
        $title = $request->title;
        $slug = Str::slug($request->slug);
        $badge = [
            'product_attr_badge_icon_url' => $request->product_attr_badge_icon_url,
            'product_attr_badge_background' => $request->product_attr_badge_background,
            'product_attr_badge_text' => $request->product_attr_badge_text,
        ];
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

            $productMeta = !all_null_array($badge) ? $this->productMetaRepository->model()->firstOrCreate([
                'key' => ModelMetaKey::BADGE,
                'value' => serialize($badge),
                'product_id' => $product->id,
            ]) : null;

            $productMeta = !all_null_array($compareTags) ? $this->productMetaRepository->model()->firstOrCreate([
                'key' => ModelMetaKey::COMPARE_TAGS,
                'value' => serialize($compareTags),
                'product_id' => $product->id,
            ]) : null;

            $productMeta = !all_null_array($topTags) ? $this->productMetaRepository->model()->firstOrCreate([
                'key' => ModelMetaKey::TOP_TAGS,
                'value' => serialize($topTags),
                'product_id' => $product->id,
            ]) : null;

            foreach ($request->all() as $key => $value) {
                if (!in_array($key, $this->autoFillData)) {
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
