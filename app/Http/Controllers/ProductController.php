<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUpdateReplicateProductRequest;
use App\Repositories\Eloquents\ProductMetaRepository;
use App\Repositories\Eloquents\ProductRepository;
use App\Repositories\Eloquents\TermRepository;
use App\Repositories\Eloquents\TermTaxonomyRepository;
use App\Services\ProductServices\ReplicateProductService;
use App\Services\ProductServices\CreateNewProductService;
use App\Services\ProductServices\PageCreateProductService;
use App\Services\ProductServices\PageEditProductService;
use App\Services\ProductServices\GenerateProductCardListViewService;
use App\Services\ProductServices\GenerateProductCardViewService;
use App\Services\ProductServices\GetProductCardViewByDataService;
use App\Services\ProductServices\GetVariantCardViewBySlugAndTermService;
use App\Services\ProductServices\PageProductDetailService;
use App\Services\ProductServices\UpdateProductService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function __construct(
        protected ProductRepository $productRepository,
        protected ProductMetaRepository $productMetaRepository,
        protected TermRepository $termRepository,
        protected TermTaxonomyRepository $termTaxonomyRepository,
        protected CreateNewProductService $createNewProductService,
        protected UpdateProductService $updateProductService,
        protected ReplicateProductService $replicateProductService,
        protected GenerateProductCardListViewService $generateProductCardListViewService,
        protected GenerateProductCardViewService $generateProductCardViewService,
        protected GetVariantCardViewBySlugAndTermService $getVariantCardViewBySlugAndTermService,
        protected GetProductCardViewByDataService $getProductCardViewByDataService,
        protected PageCreateProductService $pageCreateProductService,
        protected PageEditProductService $pageEditProductService,
        protected PageProductDetailService $pageProductDetailService
    ) {}

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
        $view = $this->pageCreateProductService->__invoke();

        return $view;
    }

    public function store(CreateUpdateReplicateProductRequest $request)
    {
        $newSlug = $this->createNewProductService->__invoke($request);

        return redirect()->route('admin.products.slug', $newSlug);
    }

    public function show(string $slug) {
        $view = $this->pageProductDetailService->__invoke($slug);

        return $view;
    }

    public function edit(string $slug)
    {
        $view = $this->pageEditProductService->__invoke($slug);

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
        $view = $this->getVariantCardViewBySlugAndTermService->__invoke($slug);

        return $view;
    }

    public function getProductCardByData(CreateUpdateReplicateProductRequest $request)
    {
        $view = $this->getProductCardViewByDataService->__invoke($request);

        return response()->json(['data' => $view]);
    }
}
