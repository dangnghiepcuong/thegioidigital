<?php

namespace App\Services\ProductServices;

use App\Enums\ModelMetaKey;
use App\Http\Requests\CreateUpdateReplicateProductRequest;
use App\Models\Product;
use App\Repositories\Eloquents\ProductMetaRepository;
use App\Repositories\Eloquents\ProductRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UpdateProductService
{
    public const AUTO_FILLABLE_DATA = [
        ModelMetaKey::TOP_TAGS,
        ModelMetaKey::BADGE_BACKGROUND_STYLE,
        ModelMetaKey::BADGE_BACKGROUND_COLOR_1,
        ModelMetaKey::BADGE_BACKGROUND_COLOR_2,
        ModelMetaKey::BADGE_BACKGROUND_URL,
        ModelMetaKey::BADGE_ICON_URL,
        ModelMetaKey::BADGE_TEXT,
        ModelMetaKey::BADGE_TEXT_COLOR,
        ModelMetaKey::THUMB_URL,
        ModelMetaKey::BOTTOM_LEFT_STAMP_URL,
        ModelMetaKey::TOP_RIGHT_STAMP_URL,
        ModelMetaKey::LIST_PRICE,
        ModelMetaKey::COMPARE_TAGS,
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
        private ProductRepository     $productRepository,
        private ProductMetaRepository $productMetaRepository,
    )
    {
        //
    }

    public function __invoke(CreateUpdateReplicateProductRequest $request, string $slug): RedirectResponse
    {
        $termTaxonomyIds = explode("\r\n", $request->input('term_taxonomy_ids'));
        $termTaxonomyIds = array_filter($termTaxonomyIds, function ($item) {
            return $item !== null && $item !== '';
        });

        try {
            DB::beginTransaction();
            $product = $this->productRepository->withoutGlobalScopes()->firstWhere('slug', $slug);
            self::updateSingleProduct($request, $product);

            !all_null_array($termTaxonomyIds) ?
                $product->termTaxonomies()->syncWithPivotValues($termTaxonomyIds, ['termable_type' => 'product'])
                : $product->termTaxonomies()->sync([]);

            $variants = $this->productRepository->whereIn('slug', $request->input('variants_slug', []))
                ->where('parent_id', $product->id) // this condition ensure valid data is queried
                ->withoutGlobalScopes()
                ->get();
            $reflectProductFieldsOnVariants = $request->input('reflect_product_fields_on_variants', []);
            $reflectProductMetaFieldsOnVariants = $request->input('reflect_product_meta_fields_on_variants', []);
            $this->reflectUpdateSelectedFieldsOnProduct(
                $request,
                $variants,
                $reflectProductFieldsOnVariants,
                $reflectProductMetaFieldsOnVariants
            );

            $siblings = $this->productRepository->whereIn('slug', $request->input('siblings_slug', []))
                ->where('parent_id', $product->parent_id) // this condition ensure valid data is queried
                ->withoutGlobalScopes()
                ->get();
            $reflectProductFieldsOnSiblings = $request->input('reflect_product_fields_on_siblings', []);
            $reflectProductMetaFieldsOnSiblings = $request->input('reflect_product_meta_fields_on_siblings', []);
            $this->reflectUpdateSelectedFieldsOnProduct(
                $request,
                $siblings,
                $reflectProductFieldsOnSiblings,
                $reflectProductMetaFieldsOnSiblings
            );

            DB::commit();

            return redirect()->route('admin.products.slug', Str::slug($request->input('slug')));
        } catch (Exception $exception) {
            DB::rollBack();
            if ($exception->getCode() === '23000') {
                return redirect()->back()->withErrors(['msg' => 'The slug has already been taken']);
            }
            return redirect()->back()->withErrors(['msg' => 'Undefined error']);
        }
    }

    public function updateSingleProduct(CreateUpdateReplicateProductRequest $request, Product $product): void
    {
        $type = $request->input('type');
        $parentId = $request->input('parent_id');
        $status = $request->input('status');
        $title = $request->input('title');
        $newSlug = Str::slug($request->input('slug'));
        $description = $request->input('description');

        $product->update([
            'type' => $type,
            'parent_id' => $parentId,
            'title' => $title,
            'slug' => $newSlug,
            'status' => $status,
            'description' => $description,
        ]);

        foreach (self::AUTO_FILLABLE_DATA as $key) {
            if ($request->input($key)) {
                $this->productMetaRepository->updateOrCreate(
                    [
                        'product_id' => $product->id,
                        'key' => $key,
                    ],
                    [
                        'value' => $request->input($key),
                    ]
                );
            } else {
                $productMeta = $this->productMetaRepository->firstByConditions([
                    'product_id' => $product->id,
                    'key' => $key,
                ]);

                $productMeta?->delete();
            }
        }
    }

    public function reflectUpdateSelectedFieldsOnProduct(
        CreateUpdateReplicateProductRequest $request,
        Collection                          $reflectingProducts,
        array                               $reflectingProductFields,
        array                               $reflectingProductMetaFields,
    ): void
    {
        foreach ($reflectingProducts as $reflectingProduct) {
            foreach ($reflectingProductFields as $field) {
                $reflectingProduct->$field = $request->input($field);
            }

            foreach ($reflectingProductMetaFields as $field) {
                if ($request->input($field)) {
                    $this->productMetaRepository->updateOrCreate(
                        [
                            'product_id' => $reflectingProduct->id,
                            'key' => $field,
                        ],
                        [
                            'value' => $request->input($field),
                        ]
                    );
                } else {
                    $productMeta = $this->productMetaRepository->firstByConditions([
                        'product_id' => $reflectingProduct->id,
                        'key' => $field,
                    ]);

                    $productMeta?->delete();
                }
            }
        }
    }
}
