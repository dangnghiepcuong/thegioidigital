@extends('layouts.admin.index')
@section('title', 'Create Product')

@section('styles')
    @parent
    @vite($viewsDir . '/admin/products/create-edit.css')
    @vite($viewsDir . '/components/admin/products/section/sections.css')
    @vite($viewsDir . '/components/product/card/index.css')
@endsection
@section('content')
    <!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
    <div class="page-create-product">
        <div class="layout-editing-sections">
            <form id="form-create-update-product" method="POST" action="{{ route('admin.products.store') }}">
                @csrf
                <x-admin.products.section.main-info :product="$product ?? null"
                                                    :parent-products="$parentProducts ?? null"/>
                <x-admin.products.section.basic-info :product-meta="$productMeta ?? null"/>
                <x-admin.products.section.description :description="$product->description ?? null"/>
                <x-admin.products.section.meta-data :product-meta="$productMeta ?? null"/>
                <x-admin.products.section.term-taxonomy
                    :term-taxonomies="$termTaxonomies"
                    :product-term-taxonomies="$product->termTaxonomies ?? null"/>

            </form>
        </div>
        <div class="layout-demo-product">
            <div class="layout-top-right-box">
                <x-product.card.index :product="$product ?? null" :url="null"/>
                <div class="layout-summary-card">
                    <div class="layout-action-buttons">
                        <div class="item-btn" id="btn-submit-form-create-product">
                            Create
                            <span class="icon material-symbols-outlined">add_circle</span>
                        </div>
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
    @include('components.admin.products.section.popup-demo-description', ['product' => null])
@endsection

@section('scripts')
    @parent
    @vite($viewsDir . '/admin/products/create-edit-ui-interaction.js')
    @vite($viewsDir . '/admin/products/create-edit-server-interaction.js')
    @vite($viewsDir . '/components/admin/products/section/meta-data.js')
    @vite($viewsDir . '/components/admin/products/section/term-taxonomy.js')
    @vite($viewsDir . '/components/admin/products/section/wysiwyg.js')
@endsection
