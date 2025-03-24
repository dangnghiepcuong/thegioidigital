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
use App\Services\ProductServices\GetVariantCardViewBySlugService;
use App\Services\ProductServices\UpdateProductService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function __construct(
        protected ProductRepository                  $productRepository,
        protected ProductMetaRepository              $productMetaRepository,
        protected TermRepository                     $termRepository,
        protected TermTaxonomyRepository             $termTaxonomyRepository,
        protected CreateNewProductService            $createNewProductService,
        protected UpdateProductService               $updateProductService,
        protected ReplicateProductService            $replicateProductService,
        protected GenerateProductCardListViewService $generateProductCardListViewService,
        protected GenerateProductCardViewService     $generateProductCardViewService,
        protected GetVariantCardViewBySlugService    $getVariantBySlugService,
        protected GetProductCardViewByDataService    $getProductCardByDataService,
        protected PageCreateProductService           $createPageProductService,
        protected PageEditProductService             $editPageProductService
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
                ->findByCondition(['parent_id' => null])
                ->with(['termTaxonomies.term'])
                ->get();

            if (!$products) {
                return view('product.dtdd', [
                    'products' => null,
                ]);
            }

            $htmlProductCardList = $this->generateProductCardListViewService->__invoke($products);

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
        $products = $this->productRepository->findByCondition(['parent_id' => null])
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

    public function show(string $slug) {

    }

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

    public function getVariantBySlug(string $slug)
    {
        try {
            DB::beginTransaction();
            $view = $this->getVariantBySlugService->__invoke($slug);
            DB::commit();

            return $view;
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    public function getProductCardByData(Request $request)
    {
        $view = $this->getProductCardByDataService->__invoke($request);

        return response()->json(['data' => $view]);
    }
}
