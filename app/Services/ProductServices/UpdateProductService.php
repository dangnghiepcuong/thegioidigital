<?php

namespace App\Services\ProductServices;

use App\Enums\ModelMetaKey;
use App\Http\Requests\CreateUpdateReplicateProductRequest;
use App\Models\Product;
use App\Repositories\Eloquents\ProductMetaRepository;
use App\Repositories\Eloquents\ProductRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UpdateProductService
{
    protected $productFieldsCanBeAppliedToVariantsOrSiblings = [
        'type',
        'parent_id',
        'title',
        'status',
        'description',
    ];
    protected $autoFillData = [
        ModelMetaKey::THUMB_URL,
        ModelMetaKey::BOTTOM_LEFT_STAMP_URL,
        ModelMetaKey::TOP_RIGHT_STAMP_URL,
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


    public function __invoke(CreateUpdateReplicateProductRequest $request, string $slug)
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
        $processedData = [
            ModelMetaKey::TOP_TAGS => $topTags,
            ModelMetaKey::BADGE => $badge,
            ModelMetaKey::COMPARE_TAGS => $compareTags,
        ];

        $termTaxonomyIds = explode("\r\n", $request->term_taxonomy_ids);

        $product = $this->productRepository->withoutGlobalScopes()->firstWhere('slug', $slug);

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

            foreach ($processedData as $key => $value) {
                $productMeta = $this->productMetaRepository->firstOrNewByConditions([
                    'product_id' => $product->id,
                    'key' => $key,
                ]);
                if (!all_null_array($value)) {
                    $productMeta->value = serialize($value);
                    $productMeta->save();
                } else {
                    $productMeta = $productMeta->delete();
                }
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

                    $productMeta?->$productMeta->delete();
                }
            }

            $result = !all_null_array($termTaxonomyIds) ?
                $product->termTaxonomies()->syncWithPivotValues($termTaxonomyIds, ['termable_type' => 'product'])
                : $product->termTaxonomies()->sync([]);

            self::applyDataToVariantsAndSiblings($product, $request);
            DB::commit();

            return redirect()->route('admin.products.slug', $newSlug);
        } catch (Exception $exception) {
            DB::rollBack();
            if ($exception->getCode() === '23000') {
                return redirect()->back()->withErrors(['msg' => 'The slug has already been taken']);
            }
            throw ($exception);
        }
    }

    public function applyDataToVariantsAndSiblings(Product $product, CreateUpdateReplicateProductRequest $request)
    {
        $appliedDataToVariants = explode(",", $request->variants_applied_data);
        $appliedDataToSiblings = explode(",", $request->siblings_applied_data);
        $type = $request->type;
        $parentId = $request->parent_id;
        $status = $request->status;
        $topTags = explode("\r\n", $request->str(ModelMetaKey::TOP_TAGS)->value());
        $compareTags = explode("\r\n", $request->str(ModelMetaKey::COMPARE_TAGS)->value());
        $title = $request->title;
        $badge = [
            'product_attr_badge_icon_url' => $request->product_attr_badge_icon_url,
            'product_attr_badge_background' => $request->product_attr_badge_background,
            'product_attr_badge_text' => $request->product_attr_badge_text,
        ];

        $description = $request->description;

        $processedData = [
            ModelMetaKey::TOP_TAGS => $topTags,
            ModelMetaKey::BADGE => $badge,
            ModelMetaKey::COMPARE_TAGS => $compareTags,
        ];

        $variants = $this->productRepository->findByConditions(['parent_id' => $product->id])
            ->withoutGlobalScopes()
            ->get();

        $siblings = $this->productRepository->findByConditions([
            ['parent_id', '=', $product->parent_id],
            ['parent_id', '!=', null],
            ['id', '!=', $product->id]
        ])
            ->withoutGlobalScopes()
            ->get();

        foreach ($variants as $variant) {
            if ($request->str($variant->slug)->value() === 'true') {
                foreach ($this->productFieldsCanBeAppliedToVariantsOrSiblings as $field) {
                    if (in_array($field, $appliedDataToVariants)) {
                        $variant->$field = $$field;
                    }
                }
                $variant->save();

                foreach ($processedData as $key => $value) {
                    $productMeta = $this->productMetaRepository->firstOrNewByConditions([
                        'product_id' => $variant->id,
                        'key' => $key,
                    ]);
                    if (!all_null_array($value)) {
                        $productMeta->value = serialize($value);
                        $productMeta->save();
                    } else {
                        $productMeta = $productMeta->delete();
                    }
                }

                foreach ($this->autoFillData as $key) {
                    if (in_array($key, $appliedDataToVariants)) {
                        if ($request->str($key)->value()) {
                            $this->productMetaRepository->updateOrCreate(
                                [
                                    'product_id' => $variant->id,
                                    'key' => $key,
                                ],
                                [
                                    'value' => $request->str($key)->value(),
                                ]
                            );
                        } else {
                            $productMeta = $this->productMetaRepository->firstByConditions([
                                'product_id' => $variant->id,
                                'key' => $key,
                            ]);
                            $productMeta = $productMeta ? $productMeta->delete() : null;
                        }
                    }
                }
            }
        }

        foreach ($siblings as $sibling) {
            if ($request->str($sibling->slug)->value() === 'true') {
                foreach ($this->productFieldsCanBeAppliedToVariantsOrSiblings as $field) {
                    if (in_array($field, $appliedDataToSiblings)) {
                        $sibling->$field = $$field;
                    }
                }
                $sibling->save();

                foreach ($processedData as $key => $value) {
                    $productMeta = $this->productMetaRepository->firstOrNewByConditions([
                        'product_id' => $sibling->id,
                        'key' => $key,
                    ]);
                    if (!all_null_array($value)) {
                        $productMeta->value = serialize($value);
                        $productMeta->save();
                    } else {
                        $productMeta = $productMeta->delete();
                    }
                }

                foreach ($this->autoFillData as $key) {
                    if (in_array($key, $appliedDataToSiblings)) {
                        if ($request->str($key)->value()) {
                            $this->productMetaRepository->updateOrCreate(
                                [
                                    'product_id' => $sibling->id,
                                    'key' => $key,
                                ],
                                [
                                    'value' => $request->str($key)->value(),
                                ]
                            );
                        } else {
                            $productMeta = $this->productMetaRepository->firstByConditions([
                                'product_id' => $sibling->id,
                                'key' => $key,
                            ]);
                            $productMeta = $productMeta ? $productMeta->delete() : null;
                        }
                    }
                }
            }
        }
    }
}
