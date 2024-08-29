<?php

namespace Database\Seeders;

use App\Enums\ModelMetaKey;
use App\Repositories\Eloquents\ProductMetaRepository;
use App\Repositories\Eloquents\ProductRepository;
use App\Repositories\Eloquents\TermRepository;
use App\Repositories\Eloquents\TermTaxonomyRepository;
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
                'description' => 'RAM/ROM',
            ]);

            $termRamRom = $this->termRepository->model()->firstOrCreate([
                'name' => '8GB - 128GB',
                'slug' => Str::slug('8GB - 128GB'),
            ]);
            $termTaxonomyRamRom = $this->termTaxonomyRepository->model()->firstOrCreate([
                'term_id' => $termRamRom->id,
                'taxonomy' => $termTaxonomyMemory->taxonomy,
                'description' => 'RAM/ROM',
                'parent_id' => $termMemory->id,
            ]);

            $termRamRom = $this->termRepository->model()->firstOrCreate([
                'name' => '6GB - 128GB',
                'slug' => Str::slug('6GB - 128GB'),
            ]);
            $termTaxonomyRamRom = $this->termTaxonomyRepository->model()->firstOrCreate([
                'term_id' => $termRamRom->id,
                'taxonomy' => $termTaxonomyMemory->taxonomy,
                'description' => 'RAM/ROM',
                'parent_id' => $termMemory->id,
            ]);

            $termRamRom = $this->termRepository->model()->firstOrCreate([
                'name' => '8GB - 256GB',
                'slug' => Str::slug('8GB - 256GB'),
            ]);
            $termTaxonomyRamRom = $this->termTaxonomyRepository->model()->firstOrCreate([
                'term_id' => $termRamRom->id,
                'taxonomy' => $termTaxonomyMemory->taxonomy,
                'description' => 'RAM/ROM',
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

            $termColor = $this->termRepository->model()->firstOrCreate([
                'name' => 'yellow',
                'slug' => Str::slug('yellow'),
            ]);
            $termTaxonomyColor = $this->termTaxonomyRepository->model()->firstOrCreate([
                'term_id' => $termColor->id,
                'taxonomy' => ModelMetaKey::COLOR,
                'description' => 'yellow',
            ]);

            $termColor = $this->termRepository->model()->firstOrCreate([
                'name' => 'black',
                'slug' => Str::slug('black'),
            ]);
            $termTaxonomyColor = $this->termTaxonomyRepository->model()->firstOrCreate([
                'term_id' => $termColor->id,
                'taxonomy' => ModelMetaKey::COLOR,
                'description' => 'black',
            ]);

            $termColor = $this->termRepository->model()->firstOrCreate([
                'name' => 'green',
                'slug' => Str::slug('green'),
            ]);
            $termTaxonomyColor = $this->termTaxonomyRepository->model()->firstOrCreate([
                'term_id' => $termColor->id,
                'taxonomy' => ModelMetaKey::COLOR,
                'description' => 'green',
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

            // dump($productsMeta);
            foreach ($productsMeta as $productMeta) {
                $term = $this->termRepository->findByConditions(['name' => $productMeta->value])
                    ->with('termTaxonomy')
                    ->first();

                $productMeta->product->termTaxonomies()->syncWithoutDetaching([$term->termTaxonomy->id => ['termable_type' => 'product']]);
            }

            DB::commit();
        } catch (\Exception $exception) {
            throw $exception;
            DB::rollBack();
        }

        // Attach term memory (RAM/ROM) to product
        try {
            DB::beginTransaction();
            $products = $this->productRepository->all();
            foreach ($products as $product) {
                if (!$product->parent_id) {
                    continue;
                }

                $productRam = $this->productMetaRepository->findByConditions([
                    'product_id' => $product->id,
                    'key' => ModelMetaKey::RAM,
                ])->first();
                $productRom = $this->productMetaRepository->findByConditions([
                    'product_id' => $product->id,
                    'key' => ModelMetaKey::ROM,
                ])->first();

                $ram = $productRam->value ?? '';
                $rom = $productRom->value ?? '';

                $productMemory = "$ram - $rom";
                dump($product->title);
                dump($productMemory);
                $term = $this->termRepository->findByConditions(['name' => $productMemory])->first();
                $termTaxonomy = $this->termTaxonomyRepository->find([
                    'term_id' => $term->id,
                    'taxonomy' => ModelMetaKey::MEMORY,
                ])->first();

                $product->termTaxonomies()->syncWithoutDetaching([$termTaxonomy->id => ['termable_type' => 'product']]);
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw ($exception);
        }
    }
}
