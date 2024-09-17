@extends('layouts.admin.index')
@section('title', 'Product List')

@section('styles')
    @vite($viewsDir . '/layouts/product/index.css')
    @vite($viewsDir . '/product/dtdd.css')
    @vite($viewsDir . '/components/product/card/index.css')
    <style>
        .layout-list-product {
            grid-template-columns: repeat(6, minmax(0, 1fr));
        }
    </style>
@endsection
@section('content')
    <x-partial.filter.product />
    <div class="most-filters-row">
        <span class="most-filter-label">Tìm kiếm nhiều: </span>
        <x-partial.filter.product.label-brand :brand-logo-link="'https://cdnv2.tgdd.vn/mwg-static/common/Category/92/e5/92e5003382a0bada9a770618b6c6099b.png'" />
        <x-partial.filter.product.label-brand :brand-logo-link="'https://cdnv2.tgdd.vn/mwg-static/common/Category/31/ce/31ce9dafafac121361ee7cbd313ae76b.png'" />
        <x-partial.filter.product.label-brand :route="route('product.dtdd-xiaomi')" :brand-logo-link="'https://cdnv2.tgdd.vn/mwg-static/common/Category/e6/02/e602583e5e16acedfe54ab41b08b5d4f.png'" />
        <x-partial.filter.product.label-brand :brand-logo-link="'https://cdnv2.tgdd.vn/mwg-static/common/Category/b6/26/b62674c18cc7ec4de1de3670812af13d.png'" />
        <x-partial.filter.product.label-brand :text="'Chơi game'" />
        <x-partial.filter.product.label-brand :text="'Pin khủng'" />
    </div>

    <x-product.list.index>
        @foreach ($products as $product)
            <x-product.card.index :product="$product" :selected-variant-meta="$product->productMetaInCardView ?? null" :url="route('admin.products.slug', $product->slug ?? '')" />
        @endforeach
    </x-product.list.index>
@endsection

@section('scripts')
    @vite($viewsDir . '/components/product/card/index.js')
@endsection
