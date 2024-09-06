<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUpdateCopyProductRequest;
use App\Repositories\Eloquents\ProductMetaRepository;
use App\Repositories\Eloquents\ProductRepository;
use App\Repositories\Eloquents\TermRepository;
use App\Repositories\Eloquents\TermTaxonomyRepository;
use App\Services\ProductServices\CopyProductService;
use App\Services\ProductServices\CreateNewProductService;
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
    protected CopyProductService $copyProductService;

    public function __construct(
        ProductRepository $productRepository,
        ProductMetaRepository $productMetaRepository,
        TermRepository $termRepository,
        TermTaxonomyRepository $termTaxonomyRepository,
        CreateNewProductService $createNewProductService,
        UpdateProductService $updateProductService,
        CopyProductService $copyProductService
    ) {
        $this->productRepository = $productRepository;
        $this->productMetaRepository = $productMetaRepository;
        $this->termRepository = $termRepository;
        $this->termTaxonomyRepository = $termTaxonomyRepository;
        $this->createNewProductService = $createNewProductService;
        $this->updateProductService = $updateProductService;
        $this->copyProductService = $copyProductService;
    }

    public function index()
    {
        $products = $this->productRepository
            ->with(['termTaxonomies.term'])
            ->get();

        if (!$products) {
            return view('product.dtdd', [
                'products' => null,
            ]);
        }

        $productVariants = $this->productRepository->whereIn('parent_id', $products->pluck('id'))
            ->with(['productMeta'])
            ->orderBy('title')
            ->paginate(config('parameter.default_paginate_number'));

        return view('admin.products.index', [
            'products' => $products,
            'productVariants' => $productVariants,
        ]);
    }

    public function dtdd(Request $request, ?string $slug = null)
    {
        $products = $this->productRepository->findByConditions(['parent_id' => null])
            ->with(['termTaxonomies.term'])
            ->get();

        if (!$products) {
            return view('product.dtdd', [
                'products' => null,
            ]);
        }

        $variants = $this->productRepository->model()->whereIn('parent_id', $products->pluck('id'))
            ->with('productMeta')
            ->get();

        return view('product.dtdd', [
            'products' => $products,
            'variants' => $variants,
        ]);
    }

    public function dtddXiaomi(Request $request)
    {
        return view('product.dtdd');
    }

    public function getParentProducts(Request $request)
    {
        $products = $this->productRepository->findByConditions(['parent_id' => null])
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

    public function store(CreateUpdateCopyProductRequest $request)
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
                ->where('slug', $slug)
                ->firstOrFail();

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
        ]);
    }

    public function update(CreateUpdateCopyProductRequest $request, string $slug)
    {
        $newSlug = $this->updateProductService->__invoke($request, $slug);
        return redirect()->route('admin.products.slug', $newSlug);
    }

    public function destroy(string $id)
    {
        //
    }

    public function copy(Request $request, $slug)
    {
        $newSlug = $this->copyProductService->__invoke($request, $slug);
        return redirect()->route('admin.products.slug', $newSlug);
    }
}
