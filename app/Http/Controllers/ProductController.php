<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUpdateReplicateProductRequest;
use App\Http\Requests\GetProductVariantBySlugAndTermRequest;
use App\Http\Requests\UploadImageRequest;
use App\Repositories\Eloquents\ProductMetaRepository;
use App\Repositories\Eloquents\ProductRepository;
use App\Repositories\Eloquents\TermRepository;
use App\Repositories\Eloquents\TermTaxonomyRepository;
use App\Services\FileServices\UploadImageService;
use App\Services\ProductServices\ReplicateProductService;
use App\Services\ProductServices\CreateNewProductService;
use App\Services\ProductServices\GenerateProductCardListViewService;
use App\Services\ProductServices\GenerateProductCardViewService;
use App\Services\ProductServices\UpdateProductService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    protected ProductRepository $productRepository;
    protected ProductMetaRepository $productMetaRepository;
    protected TermRepository $termRepository;
    protected TermTaxonomyRepository $termTaxonomyRepository;
    protected CreateNewProductService $createNewProductService;
    protected UpdateProductService $updateProductService;
    protected ReplicateProductService $replicateProductService;
    protected GenerateProductCardListViewService $generateProductCardListViewService;
    protected GenerateProductCardViewService $generateProductCardViewService;
    protected UploadImageService $uploadImageService;

    public function __construct(
        ProductRepository $productRepository,
        ProductMetaRepository $productMetaRepository,
        TermRepository $termRepository,
        TermTaxonomyRepository $termTaxonomyRepository,
        CreateNewProductService $createNewProductService,
        UpdateProductService $updateProductService,
        ReplicateProductService $replicateProductService,
        GenerateProductCardListViewService $generateProductCardListViewService,
        GenerateProductCardViewService $generateProductCardViewService,
        UploadImageService $uploadImageService
    ) {
        $this->productRepository = $productRepository;
        $this->productMetaRepository = $productMetaRepository;
        $this->termRepository = $termRepository;
        $this->termTaxonomyRepository = $termTaxonomyRepository;
        $this->createNewProductService = $createNewProductService;
        $this->updateProductService = $updateProductService;
        $this->replicateProductService = $replicateProductService;
        $this->generateProductCardListViewService = $generateProductCardListViewService;
        $this->generateProductCardViewService = $generateProductCardViewService;
        $this->uploadImageService = $uploadImageService;
    }

    public function index()
    {
        $products = $this->productRepository
            ->with(['termTaxonomies.term'])
            ->withoutGlobalScopes()
            ->get();

        if (!$products) {
            return view('product.dtdd', [
                'products' => null,
            ]);
        }

        $productVariants = $this->productRepository
            ->whereIn('parent_id', $products->pluck('id'))
            ->with(['productMetaInCardView'])
            ->orderBy('title')
            ->withoutGlobalScopes()
            ->get();

        return view('admin.products.index', [
            'products' => $products,
            'productVariants' => $productVariants,
        ]);
    }

    public function dtdd(Request $request, ?string $slug = null)
    {
        try {
            DB::beginTransaction();
            $products = $this->productRepository
                ->findByConditions(['parent_id' => null])
                ->with(['termTaxonomies.term'])
                ->get();

            if (!$products) {
                return view('product.dtdd', [
                    'products' => null,
                ]);
            }

            $variants = $this->productRepository->model()->whereIn('parent_id', $products->pluck('id'))
                ->with(['productMetaInCardView'])
                ->get();

            $htmlProductCardList = $this->generateProductCardListViewService->__invoke($products, $variants);

            DB::commit();

            return view('product.dtdd', [
                'htmlProductCardList' => $htmlProductCardList,
            ]);
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    public function dtddXiaomi(Request $request)
    {
        return view('product.dtdd');
    }

    public function getParentProducts(Request $request)
    {
        $products = $this->productRepository->findByConditions(['parent_id' => null])
            ->withoutGlobalScopes()
            ->paginate(config('parameter.default_paginate_number'));

        return response()->json($products);
    }

    public function create()
    {
        $termTaxonomies = $this->termTaxonomyRepository->model()
            ->where('taxonomy', 'like', 'product_attr_%')
            ->get();

        return view('admin.products.create', [
            'termTaxonomies' => $termTaxonomies,
        ]);
    }

    public function store(CreateUpdateReplicateProductRequest $request)
    {
        $newSlug = $this->createNewProductService->__invoke($request);
        return redirect()->route('admin.products.slug', $newSlug);
    }

    public function show(string $slug) {}

    public function edit(string $slug)
    {
        try {
            DB::beginTransaction();
            $termTaxonomies = $this->termTaxonomyRepository->model()
                ->where('taxonomy', 'like', 'product_attr_%')
                ->get();

            $product = $this->productRepository->with(['productMeta', 'termTaxonomies'])
                ->withoutGlobalScopes()
                ->where('slug', $slug)
                ->firstOrFail();

            $variants = $this->productRepository->findByConditions(['parent_id' => $product->id])
                ->withoutGlobalScopes()
                ->with(['productMetaInCardView'])
                ->get();

            $siblings = $this->productRepository->findByConditions([
                ['parent_id', '=', $product->parent_id],
                ['parent_id', '!=', null],
                ['id', '!=', $product->id]
            ])->with(['productMetaInCardView'])
                ->withoutGlobalScopes()
                ->get();

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

        return view('admin.products.edit', [
            'product' => $product,
            'productMeta' => $product->productMeta,
            'productTermTaxonomies' => $product->termTaxonomies,
            'termTaxonomies' => $termTaxonomies,
            'variants' => $variants,
            'siblings' => $siblings,
        ]);
    }

    public function update(CreateUpdateReplicateProductRequest $request, string $slug)
    {
        $newSlug = $this->updateProductService->__invoke($request, $slug);
        return redirect()->route('admin.products.slug', $newSlug);
    }

    public function destroy(string $id)
    {
        //
    }

    public function replicate(Request $request, $slug)
    {
        $newSlug = $this->replicateProductService->__invoke($request, $slug);
        return redirect()->route('admin.products.slug', $newSlug);
    }

    public function getProductVariantBySlugAndTerm(GetProductVariantBySlugAndTermRequest $request, string $slug)
    {
        try {
            DB::beginTransaction();
            $product = $this->productRepository
                ->findByConditions(['slug' => $slug])
                ->with(['productMetaInCardView'])
                ->first();
            $siblings = $this->productRepository->findByConditions(['parent_id' => $product->parent_id])
                ->with(['productMetaInCardView'])
                ->get();
            $parent = $product->parent()->with(['termTaxonomies.term'])->first();

            DB::commit();

            $html = $this->generateProductCardViewService->__invoke($product, $siblings, $parent);

            return $html;
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    public function uploadImage(UploadImageRequest $request)
    {
        $response = $this->uploadImageService->__invoke($request);
        return $response;
    }
}
