<?php

namespace Database\Seeders;

use App\Enums\ModelMetaKey;
use App\Repositories\Eloquents\ProductMetaRepository;
use App\Repositories\Eloquents\ProductRepository;
use App\Repositories\Eloquents\TermRepository;
use App\Repositories\Eloquents\TermTaxonomyRepository;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PhpParser\Node\Expr\AssignOp\Mod;

class TermSeeder extends Seeder
{
    private TermRepository $termRepository;
    private TermTaxonomyRepository $termTaxonomyRepository;
    private ProductMetaRepository $productMetaRepository;
    private ProductRepository $productRepository;

    public function __construct(
        TermRepository $termRepository,
        TermTaxonomyRepository $termTaxonomyRepository,
        ProductMetaRepository $productMetaRepository,
        ProductRepository $productRepository
    ) {
        $this->termRepository = $termRepository;
        $this->termTaxonomyRepository = $termTaxonomyRepository;
        $this->productMetaRepository = $productMetaRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Taxonomy memory
        try {
            DB::beginTransaction();

            $termMemory = $this->termRepository->model()->firstOrCreate([
                'name' => 'memory',
                'slug' => Str::slug('memory'),
            ]);
            $termTaxonomyMemory = $this->termTaxonomyRepository->model()->firstOrCreate([
                'term_id' => $termMemory->id,
                'taxonomy' => ModelMetaKey::MEMORY,
                'description' => 'RAM/Storage',
            ]);

            $termRamStorage = $this->termRepository->model()->firstOrCreate([
                'name' => '8GB - 128GB',
                'slug' => Str::slug('8GB - 128GB'),
            ]);
            $termTaxonomyRamStorage = $this->termTaxonomyRepository->model()->firstOrCreate([
                'term_id' => $termRamStorage->id,
                'taxonomy' => $termTaxonomyMemory->taxonomy,
                'description' => $termRamStorage->name,
                'parent_id' => $termMemory->id,
            ]);

            $termRamStorage = $this->termRepository->model()->firstOrCreate([
                'name' => '6GB - 128GB',
                'slug' => Str::slug('6GB - 128GB'),
            ]);
            $termTaxonomyRamStorage = $this->termTaxonomyRepository->model()->firstOrCreate([
                'term_id' => $termRamStorage->id,
                'taxonomy' => $termTaxonomyMemory->taxonomy,
                'description' => $termRamStorage->name,
                'parent_id' => $termMemory->id,
            ]);

            $termRamStorage = $this->termRepository->model()->firstOrCreate([
                'name' => '8GB - 256GB',
                'slug' => Str::slug('8GB - 256GB'),
            ]);
            $termTaxonomyRamStorage = $this->termTaxonomyRepository->model()->firstOrCreate([
                'term_id' => $termRamStorage->id,
                'taxonomy' => $termTaxonomyMemory->taxonomy,
                'description' => $termRamStorage->name,
                'parent_id' => $termMemory->id,
            ]);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
        }

        // Taxonomy color
        try {
            $termColor = $this->termRepository->model()->firstOrCreate([
                'name' => 'color',
                'slug' => Str::slug('color'),
            ]);
            $termTaxonomyColor = $this->termTaxonomyRepository->model()->firstOrCreate([
                'term_id' => $termColor->id,
                'taxonomy' => ModelMetaKey::COLOR,
                'description' => 'color',
            ]);

            $termYellow = $this->termRepository->model()->firstOrCreate([
                'name' => 'yellow',
                'slug' => Str::slug('yellow'),
            ]);
            $termTaxonomyColor = $this->termTaxonomyRepository->model()->firstOrCreate([
                'term_id' => $termYellow->id,
                'taxonomy' => ModelMetaKey::COLOR,
                'description' => 'yellow',
                'parent_id' => $termColor->id,
            ]);

            $termBlack = $this->termRepository->model()->firstOrCreate([
                'name' => 'black',
                'slug' => Str::slug('black'),
            ]);
            $termTaxonomyColor = $this->termTaxonomyRepository->model()->firstOrCreate([
                'term_id' => $termBlack->id,
                'taxonomy' => ModelMetaKey::COLOR,
                'description' => 'black',
                'parent_id' => $termColor->id,
            ]);

            $termGreen = $this->termRepository->model()->firstOrCreate([
                'name' => 'green',
                'slug' => Str::slug('green'),
            ]);
            $termTaxonomyColor = $this->termTaxonomyRepository->model()->firstOrCreate([
                'term_id' => $termGreen->id,
                'taxonomy' => ModelMetaKey::COLOR,
                'description' => 'green',
                'parent_id' => $termColor->id,
            ]);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
        }

        // Attach term color to product
        try {
            $productsMeta = $this->productMetaRepository
                ->findByConditions(['key' => ModelMetaKey::COLOR])
                ->with('product')
                ->get();

            foreach ($productsMeta as $productMeta) {
                $term = $this->termRepository->findByConditions(['name' => $productMeta->value])
                    ->first();

                $parentProduct = $this->productRepository->findOrFail($productMeta->product->parent_id)->first();
                $parentProduct->termTaxonomies()->syncWithoutDetaching([$term->termTaxonomy->id => ['termable_type' => 'product']]);
            }

            DB::commit();
        } catch (\Exception $exception) {
            throw $exception;
            DB::rollBack();
        }

        // Attach term memory (RAM/Storage) to product
        try {
            DB::beginTransaction();
            $products = $this->productRepository->all();
            foreach ($products as $product) {
                if (!$product->parent_id) {
                    DB::rollBack();
                    continue;
                }

                $productRam = $this->productMetaRepository->findByConditions([
                    'product_id' => $product->id,
                    'key' => ModelMetaKey::RAM,
                ])->first();
                $productStorage = $this->productMetaRepository->findByConditions([
                    'product_id' => $product->id,
                    'key' => ModelMetaKey::STORAGE,
                ])->first();

                $ram = $productRam->value ?? '';
                $storage = $productStorage->value ?? '';

                $productMemory = "$ram - $storage";
                $term = $this->termRepository->findByConditions(['name' => $productMemory])->first();
                if (!$term) {
                    DB::rollBack();
                    continue;
                }

                $parentProduct = $this->productRepository->findOrFail($productMeta->product->parent_id)->first();
                $parentProduct->termTaxonomies()->syncWithoutDetaching([$term->termTaxonomy->id => ['termable_type' => 'product']]);
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw ($exception);
        }

        try {
            DB::beginTransaction();
            $termStorage = $this->termRepository->model()->firstOrCreate([
                'name' => 'storage',
                'slug' => Str::slug('storage'),
            ]);
            $termTaxonomyStorage = $this->termTaxonomyRepository->model()->firstOrCreate([
                'term_id' => $termStorage->id,
                'taxonomy' => ModelMetaKey::STORAGE,
                'description' => 'storage',
            ]);
            $termStorageParentId = $termTaxonomyStorage->id;

            $termStorage = $this->termRepository->model()->firstOrCreate([
                'name' => '16GB',
                'slug' => Str::slug('16GB'),
            ]);
            $termTaxonomyStorage = $this->termTaxonomyRepository->model()->firstOrCreate([
                'term_id' => $termStorage->id,
                'taxonomy' => ModelMetaKey::STORAGE,
                'description' => '16GB',
                'parent_id' => $termStorageParentId,
            ]);

            $termStorage = $this->termRepository->model()->firstOrCreate([
                'name' => '32GB',
                'slug' => Str::slug('32GB'),
            ]);
            $termTaxonomyStorage = $this->termTaxonomyRepository->model()->firstOrCreate([
                'term_id' => $termStorage->id,
                'taxonomy' => ModelMetaKey::STORAGE,
                'description' => '32GB',
                'parent_id' => $termStorageParentId,
            ]);

            $termStorage = $this->termRepository->model()->firstOrCreate([
                'name' => '64GB',
                'slug' => Str::slug('64GB'),
            ]);
            $termTaxonomyStorage = $this->termTaxonomyRepository->model()->firstOrCreate([
                'term_id' => $termStorage->id,
                'taxonomy' => ModelMetaKey::STORAGE,
                'description' => '64GB',
                'parent_id' => $termStorageParentId,
            ]);

            $termStorage = $this->termRepository->model()->firstOrCreate([
                'name' => '128GB',
                'slug' => Str::slug('128GB'),
            ]);
            $termTaxonomyStorage = $this->termTaxonomyRepository->model()->firstOrCreate([
                'term_id' => $termStorage->id,
                'taxonomy' => ModelMetaKey::STORAGE,
                'description' => '128GB',
                'parent_id' => $termStorageParentId,
            ]);

            $termStorage = $this->termRepository->model()->firstOrCreate([
                'name' => '256GB',
                'slug' => Str::slug('256GB'),
            ]);
            $termTaxonomyStorage = $this->termTaxonomyRepository->model()->firstOrCreate([
                'term_id' => $termStorage->id,
                'taxonomy' => ModelMetaKey::STORAGE,
                'description' => '256GB',
                'parent_id' => $termStorageParentId,
            ]);

            $termStorage = $this->termRepository->model()->firstOrCreate([
                'name' => '512GB',
                'slug' => Str::slug('512GB'),
            ]);
            $termTaxonomyStorage = $this->termTaxonomyRepository->model()->firstOrCreate([
                'term_id' => $termStorage->id,
                'taxonomy' => ModelMetaKey::STORAGE,
                'description' => '512GB',
                'parent_id' => $termStorageParentId,
            ]);

            $termStorage = $this->termRepository->model()->firstOrCreate([
                'name' => '1TB',
                'slug' => Str::slug('1TB'),
            ]);
            $termTaxonomyStorage = $this->termTaxonomyRepository->model()->firstOrCreate([
                'term_id' => $termStorage->id,
                'taxonomy' => ModelMetaKey::STORAGE,
                'description' => '1TB',
                'parent_id' => $termStorageParentId,
            ]);

            $termStorage = $this->termRepository->model()->firstOrCreate([
                'name' => '2TB',
                'slug' => Str::slug('2TB'),
            ]);
            $termTaxonomyStorage = $this->termTaxonomyRepository->model()->firstOrCreate([
                'term_id' => $termStorage->id,
                'taxonomy' => ModelMetaKey::STORAGE,
                'description' => '2TB',
                'parent_id' => $termStorageParentId,
            ]);

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }
}
