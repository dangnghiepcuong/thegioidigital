<?php

namespace Database\Seeders;

use App\Enums\ModelMetaKey;
use App\Enums\ProductTypeEnum;
use App\Repositories\Eloquents\ProductRepository;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DtddXiaomiSeeder extends Seeder
{
    private ProductRepository $productRepository;

    public function __construct(
        ProductRepository $productRepository,
    ) {
        $this->productRepository = $productRepository;
    }
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            DB::beginTransaction();
            // Parent model
            $xiaomiRedmiNote13 = $this->productRepository->model()->firstOrCreate([
                'title' => 'Xiaomi Redmi Note 13',
                'type' => ProductTypeEnum::DTDD,
                'parent_id' => null,
                'status' => 'in_stock',
                'slug' => Str::slug('Xiaomi Redmi Note 13'),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        // VARIANT 8-128-vang
        try {
            DB::beginTransaction();

            $xiaomiRedmiNote13_8_128 = $this->productRepository->model()->firstOrCreate([
                'title' => 'Xiaomi Redmi Note 13 8GB/128GB',
                'type' => ProductTypeEnum::DTDD,
                'parent_id' => $xiaomiRedmiNote13->id,
                'status' => 'in_stock',
                'slug' => Str::slug('Xiaomi Redmi Note 13 8GB 128GB mau vang'),
            ]);

            // MEMORY
            $xiaomiRedmiNote13_8_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::MEMORY],
                    ['value' => '8GB - 128GB']
                );

            // COMPARE_TAGS
            $xiaomiRedmiNote13_8_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::COMPARE_TAGS],
                    ['value' => serialize(['6.67"', 'Full HD+'])]
                );

            // BOTTOM_LEFT_BADGE_URL
            $xiaomiRedmiNote13_8_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::BOTTOM_LEFT_STAMP_URL],
                    ['value' => 'https://cdn.tgdd.vn/2023/10/campaign/label-tgdd-200x200.png']
                );

            // THUMB_URL
            $xiaomiRedmiNote13_8_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::THUMB_URL],
                    ['value' => 'https://cdn.tgdd.vn/Products/Images/42/309831/xiaomi-redmi-note-13-gold-thumb-600x600.jpg']
                );

            // GIFT
            $xiaomiRedmiNote13_8_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::GIFT],
                    ['value' => '300000']
                );

            // RAM
            $xiaomiRedmiNote13_8_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::RAM],
                    ['value' => '8GB']
                );

            // ROM
            $xiaomiRedmiNote13_8_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::ROM],
                    ['value' => '128GB']
                );

            // color
            $xiaomiRedmiNote13_8_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::COLOR],
                    ['value' => 'yellow']
                );

            // SCREEN_SIZE
            $xiaomiRedmiNote13_8_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::SCREEN_SIZE],
                    ['value' => '6.67"']
                );

            // SCREEN_RESOLUTION
            $xiaomiRedmiNote13_8_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::SCREEN_RESOLUTION],
                    ['value' => 'Full HD+']
                );

            // REGULAR_PRICE
            $xiaomiRedmiNote13_8_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::REGULAR_PRICE],
                    ['value' => 5290000]
                );

            // PRICE
            $xiaomiRedmiNote13_8_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::PRICE],
                    ['value' => 4990000]
                );

            // BACK_CAMERA
            $xiaomiRedmiNote13_8_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::BACK_CAMERA],
                    ['value' => 'Chính 108 MP & Phụ 8 MP, 2 MP']
                );

            // FRONT_CAMERA
            $xiaomiRedmiNote13_8_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::FRONT_CAMERA],
                    ['value' => '16 MP']
                );

            // BATTERY
            $xiaomiRedmiNote13_8_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::BATTERY],
                    ['value' => '5000 mAh']
                );

            // CHARGE_POWER
            $xiaomiRedmiNote13_8_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::CHARGE_POWER],
                    ['value' => '33W']
                );

            // BRAND
            $xiaomiRedmiNote13_8_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::BRAND],
                    ['value' => 'Xiaomi']
                );

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

        // VARIANT 8-128-den
        try {
            DB::beginTransaction();
            $xiaomiRedmiNote13_8_128 = $this->productRepository->model()->firstOrCreate([
                'title' => 'Xiaomi Redmi Note 13 8GB/128GB',
                'type' => ProductTypeEnum::DTDD,
                'parent_id' => $xiaomiRedmiNote13->id,
                'status' => 'in_stock',
                'slug' => Str::slug('Xiaomi Redmi Note 13 8GB 128GB mau den'),
            ]);

            // MEMORY
            $xiaomiRedmiNote13_8_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::MEMORY],
                    ['value' => '8GB - 128GB']
                );

            // COMPARE_TAGS
            $xiaomiRedmiNote13_8_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::COMPARE_TAGS],
                    ['value' => serialize(['6.67"', 'Full HD+'])]
                );

            // BOTTOM_LEFT_BADGE_URL
            $xiaomiRedmiNote13_8_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::BOTTOM_LEFT_STAMP_URL],
                    ['value' => 'https://cdn.tgdd.vn/2023/10/campaign/label-tgdd-200x200.png']
                );

            // THUMB_URL
            $xiaomiRedmiNote13_8_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::THUMB_URL],
                    ['value' => 'https://cdn.tgdd.vn/Products/Images/42/320460/xiaomi-redmi-note-13-black-thumb-600x600.jpg']
                );

            // GIFT
            $xiaomiRedmiNote13_8_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::GIFT],
                    ['value' => '300000']
                );

            // RAM
            $xiaomiRedmiNote13_8_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::RAM],
                    ['value' => '8GB']
                );

            // ROM
            $xiaomiRedmiNote13_8_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::ROM],
                    ['value' => '128GB']
                );

            // color
            $xiaomiRedmiNote13_8_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::COLOR],
                    ['value' => 'black']
                );

            // SCREEN_SIZE
            $xiaomiRedmiNote13_8_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::SCREEN_SIZE],
                    ['value' => '6.67"']
                );

            // SCREEN_RESOLUTION
            $xiaomiRedmiNote13_8_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::SCREEN_RESOLUTION],
                    ['value' => 'Full HD+']
                );

            // PRICE
            $xiaomiRedmiNote13_8_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::PRICE],
                    ['value' => 5290000]
                );

            // BACK_CAMERA
            $xiaomiRedmiNote13_8_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::BACK_CAMERA],
                    ['value' => 'Chính 108 MP & Phụ 8 MP, 2 MP']
                );

            // FRONT_CAMERA
            $xiaomiRedmiNote13_8_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::FRONT_CAMERA],
                    ['value' => '16 MP']
                );

            // BATTERY
            $xiaomiRedmiNote13_8_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::BATTERY],
                    ['value' => '5000 mAh']
                );

            // CHARGE_POWER
            $xiaomiRedmiNote13_8_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::CHARGE_POWER],
                    ['value' => '33W']
                );


            // BRAND
            $xiaomiRedmiNote13_8_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::BRAND],
                    ['value' => 'Xiaomi']
                );

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

        // VARIANT 8-128-xanh-la
        try {
            DB::beginTransaction();
            $xiaomiRedmiNote13_8_128 = $this->productRepository->model()->firstOrCreate([
                'title' => 'Xiaomi Redmi Note 13 8GB/128GB',
                'type' => ProductTypeEnum::DTDD,
                'parent_id' => $xiaomiRedmiNote13->id,
                'status' => 'in_stock',
                'slug' => Str::slug('Xiaomi Redmi Note 13 8GB 128GB mau xanh la'),
            ]);

            // MEMORY
            $xiaomiRedmiNote13_8_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::MEMORY],
                    ['value' => '8GB - 128GB']
                );

            // COMPARE_TAGS
            $xiaomiRedmiNote13_8_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::COMPARE_TAGS],
                    ['value' => serialize(['6.67"', 'Full HD+'])]
                );

            // BOTTOM_LEFT_BADGE_URL
            $xiaomiRedmiNote13_8_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::BOTTOM_LEFT_STAMP_URL],
                    ['value' => 'https://cdn.tgdd.vn/2023/10/campaign/label-tgdd-200x200.png']
                );

            // THUMB_URL
            $xiaomiRedmiNote13_8_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::THUMB_URL],
                    ['value' => 'https://cdn.tgdd.vn/Products/Images/42/320461/xiaomi-redmi-note-13-green-thumb-600x600.jpg']
                );

            // GIFT
            $xiaomiRedmiNote13_8_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::GIFT],
                    ['value' => '300000']
                );

            // RAM
            $xiaomiRedmiNote13_8_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::RAM],
                    ['value' => '8GB']
                );

            // ROM
            $xiaomiRedmiNote13_8_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::ROM],
                    ['value' => '128GB']
                );

            // color
            $xiaomiRedmiNote13_8_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::COLOR],
                    ['value' => 'green']
                );

            // SCREEN_SIZE
            $xiaomiRedmiNote13_8_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::SCREEN_SIZE],
                    ['value' => '6.67"']
                );

            // SCREEN_RESOLUTION
            $xiaomiRedmiNote13_8_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::SCREEN_RESOLUTION],
                    ['value' => 'Full HD+']
                );

            // PRICE
            $xiaomiRedmiNote13_8_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::PRICE],
                    ['value' => 5290000]
                );

            // BACK_CAMERA
            $xiaomiRedmiNote13_8_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::BACK_CAMERA],
                    ['value' => 'Chính 108 MP & Phụ 8 MP, 2 MP']
                );

            // FRONT_CAMERA
            $xiaomiRedmiNote13_8_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::FRONT_CAMERA],
                    ['value' => '16 MP']
                );

            // BATTERY
            $xiaomiRedmiNote13_8_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::BATTERY],
                    ['value' => '5000 mAh']
                );

            // CHARGE_POWER
            $xiaomiRedmiNote13_8_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::CHARGE_POWER],
                    ['value' => '33W']
                );

            // BRAND
            $xiaomiRedmiNote13_8_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::BRAND],
                    ['value' => 'Xiaomi']
                );

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

        // VARIANT 6-128-den
        try {
            DB::beginTransaction();
            $xiaomiRedmiNote13_6_128 = $this->productRepository->model()->firstOrCreate([
                'title' => 'Xiaomi Redmi Note 13 6GB/128GB',
                'type' => ProductTypeEnum::DTDD,
                'parent_id' => $xiaomiRedmiNote13->id,
                'status' => 'in_stock',
                'slug' => Str::slug('Xiaomi Redmi Note 13 6GB 128GB mau den'),
            ]);

            // MEMORY
            $xiaomiRedmiNote13_6_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::MEMORY],
                    ['value' => '6GB - 128GB']
                );

            // COMPARE_TAGS
            $xiaomiRedmiNote13_6_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::COMPARE_TAGS],
                    ['value' => serialize(['6.67"', 'Full HD+'])]
                );

            // BADGE
            $xiaomiRedmiNote13_6_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::BADGE],
                    ['value' => serialize([
                        'product_attr_badge_icon' => 'https://cdn.tgdd.vn/2020/10/content/icon4-50x50.png',
                        'product_attr_badge_background' => 'bg3',
                        'product_attr_badge_text' => 'Đổi 4G tặng 480K',
                    ])]
                );

            // REGULAR_PRICE
            $xiaomiRedmiNote13_6_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::REGULAR_PRICE],
                    ['value' => '4890000']
                );

            // THUMB_URL
            $xiaomiRedmiNote13_6_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::THUMB_URL],
                    ['value' => 'https://cdn.tgdd.vn/Products/Images/42/320460/xiaomi-redmi-note-13-black-thumb-600x600.jpg']
                );

            // GIFT
            $xiaomiRedmiNote13_6_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::GIFT],
                    ['value' => '300000']
                );

            // RAM
            $xiaomiRedmiNote13_6_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::RAM],
                    ['value' => '6GB']
                );

            // ROM
            $xiaomiRedmiNote13_6_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::ROM],
                    ['value' => '128GB']
                );

            // color
            $xiaomiRedmiNote13_6_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::COLOR],
                    ['value' => 'black']
                );

            // SCREEN_SIZE
            $xiaomiRedmiNote13_6_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::SCREEN_SIZE],
                    ['value' => '6.67"']
                );

            // SCREEN_RESOLUTION
            $xiaomiRedmiNote13_6_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::SCREEN_RESOLUTION],
                    ['value' => 'Full HD+']
                );

            // PRICE
            $xiaomiRedmiNote13_6_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::PRICE],
                    ['value' => 5290000]
                );

            // BACK_CAMERA
            $xiaomiRedmiNote13_6_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::BACK_CAMERA],
                    ['value' => 'Chính 108 MP & Phụ 8 MP, 2 MP']
                );

            // FRONT_CAMERA
            $xiaomiRedmiNote13_6_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::FRONT_CAMERA],
                    ['value' => '16 MP']
                );

            // BATTERY
            $xiaomiRedmiNote13_6_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::BATTERY],
                    ['value' => '5000 mAh']
                );

            // CHARGE_POWER
            $xiaomiRedmiNote13_6_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::CHARGE_POWER],
                    ['value' => '33W']
                );

            // BRAND
            $xiaomiRedmiNote13_6_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::BRAND],
                    ['value' => 'Xiaomi']
                );

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

        // VARIANT 6-128-xanh-la
        try {
            DB::beginTransaction();
            $xiaomiRedmiNote13_6_128 = $this->productRepository->model()->firstOrCreate([
                'title' => 'Xiaomi Redmi Note 13 6GB/128GB',
                'type' => ProductTypeEnum::DTDD,
                'parent_id' => $xiaomiRedmiNote13->id,
                'status' => 'in_stock',
                'slug' => Str::slug('Xiaomi Redmi Note 13 6GB 128GB mau xanh la'),
            ]);

            // MEMORY
            $xiaomiRedmiNote13_6_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::MEMORY],
                    ['value' => '6GB - 128GB']
                );

            // COMPARE_TAGS
            $xiaomiRedmiNote13_6_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::COMPARE_TAGS],
                    ['value' => serialize(['6.67"', 'Full HD+'])]
                );

            // BADGE
            $xiaomiRedmiNote13_6_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::BADGE],
                    ['value' => serialize([
                        'product_attr_badge_icon' => 'https://cdn.tgdd.vn/2020/10/content/icon4-50x50.png',
                        'product_attr_badge_background' => 'bg3',
                        'product_attr_badge_text' => 'Đổi 4G tặng 480K',
                    ])]
                );

            // REGULAR_PRICE
            $xiaomiRedmiNote13_6_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::REGULAR_PRICE],
                    ['value' => '4890000']
                );

            // THUMB_URL
            $xiaomiRedmiNote13_6_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::THUMB_URL],
                    ['value' => 'https://cdn.tgdd.vn/Products/Images/42/320461/xiaomi-redmi-note-13-green-thumb-600x600.jpg']
                );

            // GIFT
            $xiaomiRedmiNote13_6_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::GIFT],
                    ['value' => '300000']
                );

            // RAM
            $xiaomiRedmiNote13_6_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::RAM],
                    ['value' => '6GB']
                );

            // ROM
            $xiaomiRedmiNote13_6_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::ROM],
                    ['value' => '128GB']
                );

            // color
            $xiaomiRedmiNote13_6_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::COLOR],
                    ['value' => 'green']
                );

            // SCREEN_SIZE
            $xiaomiRedmiNote13_6_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::SCREEN_SIZE],
                    ['value' => '6.67"']
                );

            // SCREEN_RESOLUTION
            $xiaomiRedmiNote13_6_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::SCREEN_RESOLUTION],
                    ['value' => 'Full HD+']
                );

            // PRICE
            $xiaomiRedmiNote13_6_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::PRICE],
                    ['value' => 5290000]
                );

            // BACK_CAMERA
            $xiaomiRedmiNote13_6_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::BACK_CAMERA],
                    ['value' => 'Chính 108 MP & Phụ 8 MP, 2 MP']
                );

            // FRONT_CAMERA
            $xiaomiRedmiNote13_6_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::FRONT_CAMERA],
                    ['value' => '16 MP']
                );

            // BATTERY
            $xiaomiRedmiNote13_6_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::BATTERY],
                    ['value' => '5000 mAh']
                );

            // CHARGE_POWER
            $xiaomiRedmiNote13_6_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::CHARGE_POWER],
                    ['value' => '33W']
                );

            // BRAND
            $xiaomiRedmiNote13_6_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::BRAND],
                    ['value' => 'Xiaomi']
                );

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

        // VARIANT 8-256-xanh-la
        try {
            DB::beginTransaction();
            $xiaomiRedmiNote13_8_256 = $this->productRepository->model()->firstOrCreate([
                'title' => 'Xiaomi Redmi Note 13 8GB/256GB',
                'type' => ProductTypeEnum::DTDD,
                'parent_id' => $xiaomiRedmiNote13->id,
                'status' => 'in_stock',
                'slug' => Str::slug('Xiaomi Redmi Note 13 8GB 256GB mau xanh la'),
            ]);

            // MEMORY
            $xiaomiRedmiNote13_8_256->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::MEMORY],
                    ['value' => '8GB - 256GB']
                );

            // COMPARE_TAGS
            $xiaomiRedmiNote13_6_128->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::COMPARE_TAGS],
                    ['value' => serialize(['6.67"', 'Full HD+'])]
                );

            // BOTTOM_LEFT_BADGE_URL
            $xiaomiRedmiNote13_8_256->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::BOTTOM_LEFT_STAMP_URL],
                    ['value' => 'https://cdn.tgdd.vn/2023/10/campaign/label-tgdd-200x200.png']
                );

            // THUMB_URL
            $xiaomiRedmiNote13_8_256->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::THUMB_URL],
                    ['value' => 'https://cdn.tgdd.vn/Products/Images/42/320461/xiaomi-redmi-note-13-green-thumb-600x600.jpg']
                );

            // GIFT
            $xiaomiRedmiNote13_8_256->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::GIFT],
                    ['value' => '300000']
                );

            // RAM
            $xiaomiRedmiNote13_8_256->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::RAM],
                    ['value' => '8GB']
                );

            // ROM
            $xiaomiRedmiNote13_8_256->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::ROM],
                    ['value' => '256GB']
                );

            // color
            $xiaomiRedmiNote13_8_256->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::COLOR],
                    ['value' => 'green']
                );

            // SCREEN_SIZE
            $xiaomiRedmiNote13_8_256->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::SCREEN_SIZE],
                    ['value' => '6.67"']
                );

            // SCREEN_RESOLUTION
            $xiaomiRedmiNote13_8_256->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::SCREEN_RESOLUTION],
                    ['value' => 'Full HD+']
                );

            // PRICE
            $xiaomiRedmiNote13_8_256->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::PRICE],
                    ['value' => 5290000]
                );

            // BACK_CAMERA
            $xiaomiRedmiNote13_8_256->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::BACK_CAMERA],
                    ['value' => 'Chính 108 MP & Phụ 8 MP, 2 MP']
                );

            // FRONT_CAMERA
            $xiaomiRedmiNote13_8_256->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::FRONT_CAMERA],
                    ['value' => '16 MP']
                );

            // BATTERY
            $xiaomiRedmiNote13_8_256->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::BATTERY],
                    ['value' => '5000 mAh']
                );

            // CHARGE_POWER
            $xiaomiRedmiNote13_8_256->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::CHARGE_POWER],
                    ['value' => '33W']
                );

            // BRAND
            $xiaomiRedmiNote13_8_256->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::BRAND],
                    ['value' => 'Xiaomi']
                );

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

        // VARIANT 8-256-vang
        try {
            DB::beginTransaction();
            $xiaomiRedmiNote13_8_256 = $this->productRepository->model()->firstOrCreate([
                'title' => 'Xiaomi Redmi Note 13 8GB/256GB',
                'type' => ProductTypeEnum::DTDD,
                'parent_id' => $xiaomiRedmiNote13->id,
                'status' => 'in_stock',
                'slug' => Str::slug('Xiaomi Redmi Note 13 8GB 256GB mau vang'),
            ]);

            // MEMORY
            $xiaomiRedmiNote13_8_256->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::MEMORY],
                    ['value' => '8GB - 256GB']
                );

            // COMPARE_TAGS
            $xiaomiRedmiNote13_8_256->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::COMPARE_TAGS],
                    ['value' => serialize(['6.67"', 'Full HD+'])]
                );

            // BOTTOM_LEFT_BADGE_URL
            $xiaomiRedmiNote13_8_256->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::BOTTOM_LEFT_STAMP_URL],
                    ['value' => 'https://cdn.tgdd.vn/2023/10/campaign/label-tgdd-200x200.png']
                );

            // THUMB_URL
            $xiaomiRedmiNote13_8_256->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::THUMB_URL],
                    ['value' => 'https://cdn.tgdd.vn/Products/Images/42/309831/xiaomi-redmi-note-13-gold-thumb-600x600.jpg']
                );

            // GIFT
            $xiaomiRedmiNote13_8_256->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::GIFT],
                    ['value' => '300000']
                );

            // RAM
            $xiaomiRedmiNote13_8_256->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::RAM],
                    ['value' => '8GB']
                );

            // ROM
            $xiaomiRedmiNote13_8_256->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::ROM],
                    ['value' => '256GB']
                );

            // color
            $xiaomiRedmiNote13_8_256->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::COLOR],
                    ['value' => 'yellow']
                );

            // SCREEN_SIZE
            $xiaomiRedmiNote13_8_256->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::SCREEN_SIZE],
                    ['value' => '6.67"']
                );

            // SCREEN_RESOLUTION
            $xiaomiRedmiNote13_8_256->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::SCREEN_RESOLUTION],
                    ['value' => 'Full HD+']
                );

            // PRICE
            $xiaomiRedmiNote13_8_256->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::PRICE],
                    ['value' => 5290000]
                );

            // BACK_CAMERA
            $xiaomiRedmiNote13_8_256->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::BACK_CAMERA],
                    ['value' => 'Chính 108 MP & Phụ 8 MP, 2 MP']
                );

            // FRONT_CAMERA
            $xiaomiRedmiNote13_8_256->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::FRONT_CAMERA],
                    ['value' => '16 MP']
                );

            // BATTERY
            $xiaomiRedmiNote13_8_256->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::BATTERY],
                    ['value' => '5000 mAh']
                );

            // CHARGE_POWER
            $xiaomiRedmiNote13_8_256->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::CHARGE_POWER],
                    ['value' => '33W']
                );

            // BRAND
            $xiaomiRedmiNote13_8_256->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::BRAND],
                    ['value' => 'Xiaomi']
                );

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

        // VARIANT 8-256-den
        try {
            DB::beginTransaction();
            $xiaomiRedmiNote13_8_256 = $this->productRepository->model()->firstOrCreate([
                'title' => 'Xiaomi Redmi Note 13 8GB/256GB',
                'type' => ProductTypeEnum::DTDD,
                'parent_id' => $xiaomiRedmiNote13->id,
                'status' => 'in_stock',
                'slug' => Str::slug('Xiaomi Redmi Note 13 8GB 256GB mau den'),
            ]);

            // MEMORY
            $xiaomiRedmiNote13_8_256->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::MEMORY],
                    ['value' => '8GB - 256GB']
                );

            // COMPARE_TAGS
            $xiaomiRedmiNote13_8_256->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::COMPARE_TAGS],
                    ['value' => serialize(['6.67"', 'Full HD+'])]
                );

            // BOTTOM_LEFT_BADGE_URL
            $xiaomiRedmiNote13_8_256->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::BOTTOM_LEFT_STAMP_URL],
                    ['value' => 'https://cdn.tgdd.vn/2023/10/campaign/label-tgdd-200x200.png']
                );

            // THUMB_URL
            $xiaomiRedmiNote13_8_256->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::THUMB_URL],
                    ['value' => 'https://cdn.tgdd.vn/Products/Images/42/320460/xiaomi-redmi-note-13-black-thumb-600x600.jpg']
                );

            // GIFT
            $xiaomiRedmiNote13_8_256->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::GIFT],
                    ['value' => '300000']
                );

            // RAM
            $xiaomiRedmiNote13_8_256->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::RAM],
                    ['value' => '8GB']
                );

            // ROM
            $xiaomiRedmiNote13_8_256->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::ROM],
                    ['value' => '256GB']
                );

            // color
            $xiaomiRedmiNote13_8_256->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::COLOR],
                    ['value' => 'black']
                );

            // SCREEN_SIZE
            $xiaomiRedmiNote13_8_256->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::SCREEN_SIZE],
                    ['value' => '6.67"']
                );

            // SCREEN_RESOLUTION
            $xiaomiRedmiNote13_8_256->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::SCREEN_RESOLUTION],
                    ['value' => 'Full HD+']
                );

            // PRICE
            $xiaomiRedmiNote13_8_256->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::PRICE],
                    ['value' => 5290000]
                );

            // BACK_CAMERA
            $xiaomiRedmiNote13_8_256->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::BACK_CAMERA],
                    ['value' => 'Chính 108 MP & Phụ 8 MP, 2 MP']
                );

            // FRONT_CAMERA
            $xiaomiRedmiNote13_8_256->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::FRONT_CAMERA],
                    ['value' => '16 MP']
                );

            // BATTERY
            $xiaomiRedmiNote13_8_256->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::BATTERY],
                    ['value' => '5000 mAh']
                );

            // CHARGE_POWER
            $xiaomiRedmiNote13_8_256->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::CHARGE_POWER],
                    ['value' => '33W']
                );

            // BRAND
            $xiaomiRedmiNote13_8_256->productMeta()
                ->firstOrCreate(
                    ['key' => ModelMetaKey::BRAND],
                    ['value' => 'Xiaomi']
                );

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }
}
