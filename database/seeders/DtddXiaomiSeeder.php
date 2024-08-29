<?php

namespace Database\Seeders;

use App\Enums\ModelMetaKey;
use App\Enums\ProductType;
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
        // VARIANT 8-128-vang
        try {
            DB::beginTransaction();
            // Parent model
            $xiaomiRedmiNote13 = $this->productRepository->model()->firstOrCreate([
                'title' => 'Xiaomi Redmi Note 13',
                'type' => ProductType::DTDD,
                'parent_id' => null,
                'status' => 'in stock',
                'url' => Str::slug('Xiaomi Redmi Note 13'),
            ]);

            $xiaomiRedmiNote13_8_128 = $this->productRepository->model()->firstOrCreate([
                'title' => 'Xiaomi Redmi Note 13 8GB/128GB',
                'type' => ProductType::DTDD,
                'parent_id' => $xiaomiRedmiNote13->id,
                'status' => 'in stock',
                'url' => Str::slug('Xiaomi Redmi Note 13 8GB 128GB mau vang'),
            ]);

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
                    ['value' => 'yellow']
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
        }

        // VARIANT 8-128-den
        try {
            DB::beginTransaction();
            $xiaomiRedmiNote13_8_128 = $this->productRepository->model()->firstOrCreate([
                'title' => 'Xiaomi Redmi Note 13 8GB/128GB',
                'type' => ProductType::DTDD,
                'parent_id' => $xiaomiRedmiNote13->id,
                'status' => 'in stock',
                'url' => Str::slug('Xiaomi Redmi Note 13 8GB 128GB mau den'),
            ]);

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
                    ['value' => 'yellow']
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
        }

        // VARIANT 8-128-xanh-la
        try {
            DB::beginTransaction();
            $xiaomiRedmiNote13_8_128 = $this->productRepository->model()->firstOrCreate([
                'title' => 'Xiaomi Redmi Note 13 8GB/128GB',
                'type' => ProductType::DTDD,
                'parent_id' => $xiaomiRedmiNote13->id,
                'status' => 'in stock',
                'url' => Str::slug('Xiaomi Redmi Note 13 8GB 128GB mau xanh la'),
            ]);

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
                    ['value' => 'yellow']
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
        }

        // VARIANT 6-128-den
        try {
            DB::beginTransaction();
            $xiaomiRedmiNote13_6_128 = $this->productRepository->model()->firstOrCreate([
                'title' => 'Xiaomi Redmi Note 13 6GB/128GB',
                'type' => ProductType::DTDD,
                'parent_id' => $xiaomiRedmiNote13->id,
                'status' => 'in stock',
                'url' => Str::slug('Xiaomi Redmi Note 13 6GB 128GB mau den'),
            ]);

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
                    ['value' => 'yellow']
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
        }

        // VARIANT 6-128-xanh-la
        try {
            DB::beginTransaction();
            $xiaomiRedmiNote13_6_128 = $this->productRepository->model()->firstOrCreate([
                'title' => 'Xiaomi Redmi Note 13 6GB/128GB',
                'type' => ProductType::DTDD,
                'parent_id' => $xiaomiRedmiNote13->id,
                'status' => 'in stock',
                'url' => Str::slug('Xiaomi Redmi Note 13 6GB 128GB mau xanh la'),
            ]);

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
                    ['value' => 'yellow']
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
        }

        // VARIANT 8-256-xanh-la
        try {
            DB::beginTransaction();
            $xiaomiRedmiNote13_8_256 = $this->productRepository->model()->firstOrCreate([
                'title' => 'Xiaomi Redmi Note 13 8GB/256GB',
                'type' => ProductType::DTDD,
                'parent_id' => $xiaomiRedmiNote13->id,
                'status' => 'in stock',
                'url' => Str::slug('Xiaomi Redmi Note 13 8GB 256GB mau xanh la'),
            ]);

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
                    ['value' => 'yellow']
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
        }

        // VARIANT 8-256-vang
        try {
            DB::beginTransaction();
            $xiaomiRedmiNote13_8_256 = $this->productRepository->model()->firstOrCreate([
                'title' => 'Xiaomi Redmi Note 13 8GB/256GB',
                'type' => ProductType::DTDD,
                'parent_id' => $xiaomiRedmiNote13->id,
                'status' => 'in stock',
                'url' => Str::slug('Xiaomi Redmi Note 13 8GB 256GB mau vang'),
            ]);

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
                    ['value' => 'yellow']
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
        }

        // VARIANT 8-256-den
        try {
            DB::beginTransaction();
            $xiaomiRedmiNote13_8_256 = $this->productRepository->model()->firstOrCreate([
                'title' => 'Xiaomi Redmi Note 13 8GB/256GB',
                'type' => ProductType::DTDD,
                'parent_id' => $xiaomiRedmiNote13->id,
                'status' => 'in stock',
                'url' => Str::slug('Xiaomi Redmi Note 13 8GB 256GB mau den'),
            ]);

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
                    ['value' => 'yellow']
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
        }
    }
}
