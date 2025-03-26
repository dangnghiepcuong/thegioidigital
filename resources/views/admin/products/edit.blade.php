@extends('layouts.admin.index')
@section('title', 'Edit Product')

@section('styles')
    @parent
    @vite($viewsDir . '/admin/products/create-edit.css')
    @vite($viewsDir . '/components/admin/products/section/sections.css')
    @vite($viewsDir . '/components/product/card/index.css')
@endsection
@section('content')
    <!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
    <div class="page-edit-product">
        <div class="layout-editing-sections">
            <form id="form-create-update-product" class="form-create-update-product" method="POST"
                  action="{{ route('admin.products.update', $product->slug) }}">
                @csrf
                @method('patch')

                <x-admin.products.section.main-info :product="$product ?? null"
                                                    :parent-products="$parentProducts ?? null"/>
                <x-admin.products.section.basic-info :product-meta="$productMeta ?? null"/>
                <x-admin.products.section.description :description="$product->description ?? null"/>
                <x-admin.products.section.meta-data :product-meta="$productMeta ?? null"/>
                <x-admin.products.section.term-taxonomy
                    :term-taxonomies="$termTaxonomies"
                    :product-term-taxonomies="$product->termTaxonomies ?? null"/>
                <x-admin.products.section.variants :variants="$variants ?? null"/>
                <x-admin.products.section.siblings :siblings="$siblings ?? null"/>
            </form>
            <x-admin.products.section.upload-image
                :product-id="$product->id ?? null"
                :slider-images="$sliderImages ?? null"/>
        </div>
        <div class="layout-demo-product">
            <div class="layout-top-right-box">
                <x-product.card.index :product="$product ?? null" :selected-variant-meta="$productMeta" :url="null"/>
                <div class="layout-summary-card">
                    <div class="layout-action-buttons">
                        <div class="item-btn" id="btn-submit-form-update-product">
                            <span class="text-btn">{{ __('button.save') }}</span>
                            <span class="icon material-symbols-outlined">save</span>
                        </div>
                        <form id="form-replicate-product" method="POST"
                              action="{{ route('admin.products.replicate', $product->slug) }}">
                            <div class="item-btn" id="btn-submit-form-replicate-product">
                                @csrf
                                <span class="text-btn">{{ __('button.replicate') }}</span>
                                <span class="icon material-symbols-outlined">content_copy</span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="layout-errors">
                @foreach ($errors->all() as $error)
                    <span class="error">{{ $error }}</span>
                    <br>
                @endforeach
            </div>
        </div>
    </div>
    @include('components.admin.products.section.popup-demo-description')
    <input type="hidden" id="csrf-token" value="{{ csrf_token() }}"/>
@endsection

@section('scripts')
    @parent
    @vite($viewsDir . '/admin/products/create-edit-ui-interaction.js')
    @vite($viewsDir . '/admin/products/create-edit-server-interaction.js')
@endsection
