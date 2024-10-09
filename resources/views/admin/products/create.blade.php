@extends('layouts.admin.index')
@section('title', 'Create Product')

@section('styles')
    @parent
    @vite($viewsDir . '/admin/products/create-edit.css')
    @vite($viewsDir . '/admin/products/partials/sections.css')
    @vite($viewsDir . '/components/product/card/index.css')
@endsection
@use('App\Enums\ModelMetaKey')
@section('content')
    <!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
    <div class="page-create-product">
        <div class="layout-editing-sections">
            <form id="form-create-product" method="POST" action="{{ route('admin.products.store') }}">
                @csrf
                @include('admin.products.partials.section-main-info', ['product' => null])
                @include('admin.products.partials.section-basic-info', ['productMeta' => null])
                @include('admin.products.partials.section-description', ['product' => null])
                @include('admin.products.partials.section-meta-data', ['productMeta' => null])
                @include('admin.products.partials.section-term-taxonomy', ['productTermTaxonomies' => null])
            </form>
        </div>
        <div class="layout-demo-product">
            <div class="layout-top-right-box">
                <x-product.card.index :product="$product ?? null" :url="null" />
                <div class="layout-summary-card">
                    <div class="layout-action-buttons">
                        <div class="item-btn" id="btn-submit-form-create-product">
                            Create
                            <span class="icon material-symbols-outlined">add_circle</span>
                        </div>
                    </div>
                </div>
            </div>
            @foreach ($errors->all() as $error)
                <span class="error">{{ $error }}</span>
                <br>
            @endforeach
        </div>
    </div>
    @include('admin.products.partials.popup-demo-description', ['product' => null])
@endsection

@section('scripts')
    @parent
    @vite($viewsDir . '/admin/products/create-edit-ui-interaction.js')
    @vite($viewsDir . '/admin/products/create-edit-server-interaction.js')
    @vite($viewsDir . '/admin/products/partials/wysiwyg.js')
@endsection
