@extends('layouts.admin.index')
@section('title', 'Edit Product')

@section('styles')
    @parent
    @vite($viewsDir . '/admin/products/create-edit.css')
    @vite($viewsDir . '/admin/products/partials/sections.css')
    @vite($viewsDir . '/components/product/card/index.css')
@endsection
@use('App\Enums\ModelMetaKey')
@section('content')
    <!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
    <div class="page-edit-product">
        <div class="layout-editing-sections">
            <form id="form-update-product" class="form-update-product" method="POST"
                action="{{ route('admin.products.update', $product->slug) }}">
                @csrf
                @method('patch')

                @include('admin.products.partials.section-main-info')
                @include('admin.products.partials.section-basic-info')
                @include('admin.products.partials.section-description')
                @include('admin.products.partials.section-meta-data')
                @include('admin.products.partials.section-term-taxonomy')
                @include('admin.products.partials.section-variants')
                @include('admin.products.partials.section-siblings')
            </form>
            @include('admin.products.partials.section-upload-image')
        </div>
        <div class="layout-demo-product">
            <div class="layout-top-right-box">
                <x-product.card.index :product="$product ?? null" :url="null" />
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
    @include('admin.products.partials.popup-demo-description')
    <input type="hidden" id="csrf-token" value="{{ csrf_token() }}" />
@endsection

@section('scripts')
    @parent
    @vite($viewsDir . '/admin/products/create-edit-ui-interaction.js')
    @vite($viewsDir . '/admin/products/create-edit-server-interaction.js')
    @vite($viewsDir . '/admin/products/partials/wysiwyg.js')
    @vite($viewsDir . '/admin/products/partials/file-upload.js')
@endsection
