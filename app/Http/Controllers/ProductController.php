<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Repositories\Eloquents\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private ProductRepository $productRepository;

    public function __construct(
        ProductRepository $productRepository
    ) {
        $this->productRepository = $productRepository;
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

    public function dtddXiaomi(Request $request, ?string $slug = null)
    {
        return view('product.dtdd');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
