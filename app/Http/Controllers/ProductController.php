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
    )
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        //
    }

    public function dtdd(Request $request, ?string $slug = null)
    {
        $products = $this->productRepository->findByConditions(['parent_id' => null])->get();

        if (!$products) {
            return view('product.dtdd', [
                'products' => null,
            ]);
        }

        if ($products->count() === 1) {
            $products = $this->productRepository->findByConditions(['parent_id' => $products[0]->id])
                ->with(['productMeta'])
                ->orderBy('title')
                ->paginate(config('parameter.default_paginate_number'));
        }

        return view('product.dtdd', [
            'products' => $products,
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
