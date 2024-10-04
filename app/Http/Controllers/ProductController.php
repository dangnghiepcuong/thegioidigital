<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUpdateReplicateProductRequest;
use App\Http\Requests\UploadImageRequest;
use App\Repositories\Eloquents\ProductMetaRepository;
use App\Repositories\Eloquents\ProductRepository;
use App\Repositories\Eloquents\TermRepository;
use App\Repositories\Eloquents\TermTaxonomyRepository;
use App\Services\FileServices\UploadImageService;
use App\Services\ProductServices\ReplicateProductService;
use App\Services\ProductServices\CreateNewProductService;
use App\Services\ProductServices\CreatePageProductService;
use App\Services\ProductServices\EditPageProductService;
use App\Services\ProductServices\GenerateProductCardListViewService;
use App\Services\ProductServices\GenerateProductCardViewService;
use App\Services\ProductServices\GetVariantBySlugAndTermService;
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
    protected GetVariantBySlugAndTermService $getVariantBySlugAndTermService;
    protected UploadImageService $uploadImageService;
    protected CreatePageProductService $createPageProductService;
    protected EditPageProductService $editPageProductService;

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
        GetVariantBySlugAndTermService $getVariantBySlugAndTermService,
        UploadImageService $uploadImageService,
        CreatePageProductService $createPageProductService,
        EditPageProductService $editPageProductService
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
        $this->getVariantBySlugAndTermService = $getVariantBySlugAndTermService;
        $this->uploadImageService = $uploadImageService;
        $this->createPageProductService = $createPageProductService;
        $this->editPageProductService = $editPageProductService;
    }

    public function index()
    {
        $products = $this->productRepository
            ->with(['termTaxonomies.term'])
            ->orderBy('title')
            ->withoutGlobalScopes()
            ->get();

        if (!$products) {
            return view('product.dtdd', [
                'products' => null,
            ]);
        }

        return view('admin.products.index', [
            'products' => $products,
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
        $view = $this->createPageProductService->__invoke();

        return $view;
    }

    public function store(CreateUpdateReplicateProductRequest $request)
    {
        $newSlug = $this->createNewProductService->__invoke($request);

        return redirect()->route('admin.products.slug', $newSlug);
    }

    public function show(string $slug) {}

    public function edit(string $slug)
    {
        $view = $this->editPageProductService->__invoke($slug);

        return $view;
    }

    public function update(CreateUpdateReplicateProductRequest $request, string $slug)
    {
        return $this->updateProductService->__invoke($request, $slug);
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

    public function getVariantBySlugAndTerm(string $slug)
    {
        $view = $this->getVariantBySlugAndTermService->__invoke($slug);

        return $view;
    }

    public function uploadImage(UploadImageRequest $request)
    {
        $response = $this->uploadImageService->__invoke($request);

        return $response;
    }
}
