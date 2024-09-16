<?php

namespace App\Services\ProductServices;

use App\Enums\ModelMetaKey;
use App\Http\Requests\CreateUpdateCopyProductRequest;
use App\Repositories\Eloquents\ProductMetaRepository;
use App\Repositories\Eloquents\ProductRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UpdateProductService
{
    protected ProductRepository $productRepository;
    protected ProductMetaRepository $productMetaRepository;
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
        ProductRepository $productRepository,
        ProductMetaRepository $productMetaRepository
    ) {
        $this->productRepository = $productRepository;
        $this->productMetaRepository = $productMetaRepository;
    }


    public function __invoke(CreateUpdateCopyProductRequest $request, string $slug)
    {
        $type = $request->type;
        $parentId = $request->parent_id;
        $status = $request->status;
        $topTags = explode("\r\n", $request->str(ModelMetaKey::TOP_TAGS)->value());
        $compareTags = explode("\r\n", $request->str(ModelMetaKey::COMPARE_TAGS)->value());
        $title = $request->title;
        $newSlug = Str::slug($request->slug);
        $badge = [
            'product_attr_badge_icon_url' => $request->product_attr_badge_icon_url,
            'product_attr_badge_background' => $request->product_attr_badge_background,
            'product_attr_badge_text' => $request->product_attr_badge_text,
        ];
        $description = $request->description;
        $termTaxonomyIds = explode("\r\n", $request->term_taxonomy_ids);

        try {
            DB::beginTransaction();
            $product = $this->productRepository->withoutGlobalScopes()->firstWhere('slug', $slug);
            $product->update([
                'type' => $type,
                'parent_id' => $parentId,
                'title' => $title,
                'slug' => $newSlug,
                'status' => $status,
                'description' => $description,
            ]);

            if (!all_null_array($badge)) {
                $productMeta = $this->productMetaRepository->updateOrCreate(
                    [
                        'product_id' => $product->id,
                        'key' => ModelMetaKey::BADGE,
                    ],
                    [
                        'value' => serialize($badge),
                    ]
                );
            } else {
                $productMeta = $this->productMetaRepository->firstByConditions([
                    'product_id' => $product->id,
                    'key' => ModelMetaKey::BADGE,
                ]);

                $productMeta = $productMeta ? $productMeta->delete() : null;
            }

            if (!all_null_array($compareTags)) {
                $productMeta = $this->productMetaRepository->updateOrCreate(
                    [
                        'product_id' => $product->id,
                        'key' => ModelMetaKey::COMPARE_TAGS,
                    ],
                    [
                        'value' => serialize($compareTags),
                    ]
                );
            } else {
                $productMeta = $this->productMetaRepository->firstByConditions([
                    'product_id' => $product->id,
                    'key' => ModelMetaKey::COMPARE_TAGS,
                ]);

                $productMeta = $productMeta ? $productMeta->delete() : null;
            }

            if (!all_null_array($topTags)) {
                $productMeta = $this->productMetaRepository->updateOrCreate(
                    [
                        'product_id' => $product->id,
                        'key' => ModelMetaKey::TOP_TAGS,
                    ],
                    [
                        'value' => serialize($topTags),
                    ]
                );
            } else {
                $productMeta = $this->productMetaRepository->firstByConditions([
                    'product_id' => $product->id,
                    'key' => ModelMetaKey::TOP_TAGS,
                ]);

                $productMeta = $productMeta ? $productMeta->delete() : null;
            }

            foreach ($this->autoFillData as $key) {
                if ($request->str($key)->value()) {
                    $productMeta = $this->productMetaRepository->updateOrCreate(
                        [
                            'product_id' => $product->id,
                            'key' => $key,
                        ],
                        [
                            'value' => $request->str($key)->value(),
                        ]
                    );
                } else {
                    $productMeta = $this->productMetaRepository->firstByConditions([
                        'product_id' => $product->id,
                        'key' => $key,
                    ]);

                    $productMeta = $productMeta ? $productMeta->delete() : null;
                }
            }

            $result = !all_null_array($termTaxonomyIds) ? $product->termTaxonomies()->sync($termTaxonomyIds) : $product->termTaxonomies()->sync([]);

            DB::commit();

            return $newSlug;
        } catch (Exception $exception) {
            DB::rollBack();
            throw ($exception);
        }
    }
}
