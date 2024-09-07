@extends('layouts.admin.index')
@section('title', 'Create Product')

@section('styles')
    @parent
    @vite($viewsDir . '/admin/products/create-edit.css')
    @vite($viewsDir . '/components/product/card/index.css')
@endsection
@use('App\Enums\ModelMetaKey')

@section('content')
    <form method="POST" action="{{ route('admin.products.store') }}">
        @csrf
        <div class="page-create-edit-product">
            <div class="layout-form">
                <div class="form-item">
                    <label for="form-type">type</label>
                    <select name="type" id="form-type">
                        @if (old('type'))
                            <option value="{{ old('type') }}">{{ old('type') }}</option>
                        @endif
                        @foreach ($productTypesEnum as $productType)
                            @if ($productType !== old('type'))
                                <option value="{{ $productType }}">{{ $productType }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-item">
                    <label for="form-parent-id">parent product</label>
                    <select name="parent_id" class-name="parent-id" id="parent_id" value="{{ old('parent_id') }}">
                        <option value=""></option>
                    </select>
                </div>
                <div class="form-item">
                    <label for="form-status">status</label>
                    <select name="status" id="form-status">
                        @if (old('status'))
                            <option value="{{ old('status') }}">{{ old('status') }}</option>
                        @endif
                        @foreach ($productStatusesEnum as $productStatus)
                            @if ($productStatus !== old('status'))
                                <option value="{{ $productStatus }}">{{ $productStatus }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-item demo-attribute">
                    <label for="form-top-tags">top tags</label>
                    <textarea name="{{ ModelMetaKey::TOP_TAGS }}" id="form-top-tags" cols="20" rows="2" layout="layout-top-tags"
                        element="span" class-name="top-tag" bound-attr="multiple-text/html" set="line-separated">{{ old(ModelMetaKey::TOP_TAGS) }}</textarea>
                </div>
                <div class="form-item demo-attribute">
                    <label for="form-title">title</label>
                    <input name="title" value="{{ old('title') }}" type="text" id="form-title"
                        layout="holder-product-name" element="span" class-name="product-name" bound-attr="text/html">
                </div>
                <div class="form-item">
                    <label for="form-slug">slug</label>
                    <input name="slug" value="{{ old('slug') }}" type="text" id="form-slug">
                </div>
                <div class="form-item demo-attribute">
                    <label for="form-thumb-url">thumb url</label>
                    <input name="{{ ModelMetaKey::THUMB_URL }}" value="{{ old(ModelMetaKey::THUMB_URL) }}" type="text"
                        id="form-thumb-url" layout="holder-img" element="img" class-name="thumb" bound-attr="src"
                        set="append-once">
                </div>
                <div class="form-item demo-attribute">
                    <label for="form-bottom-left-stamp-url">bottom-left stamp url</label>
                    <input name="{{ ModelMetaKey::BOTTOM_LEFT_STAMP_URL }}"
                        value="{{ old(ModelMetaKey::BOTTOM_LEFT_STAMP_URL) }}" type="text"
                        id="form-bottom-left-stamp-url" layout="holder-img" element="img" class-name="stamp bottom-left"
                        bound-attr="src" set="append-once">
                </div>
                <div class="form-item demo-attribute">
                    <label for="form-badge-icon">badge icon url</label>
                    <input name="product_attr_badge_icon_url" value="{{ old('product_attr_badge_icon_url') }}"
                        type="text" id="form-badge-icon" layout="layout-badge" element="img" class-name="badge"
                        bound-attr="src" set="append-once">
                </div>
                <div class="form-item demo-attribute">
                    <label for="form-badge-background">badge background</label>
                    <input name="product_attr_badge_background" value="{{ old('product_attr_badge_background') }}"
                        id="form-badge-layout" type="text" layout="layout-badge" bound-attr="class"
                        default-value="layout-badge" placeholder="bg1, bg2, bg3, bg4..." set="append-once">
                </div>
                <div class="form-item demo-attribute">
                    <label for="form-title">badge text</label>
                    <input name="product_attr_badge_text" value="{{ old('product_attr_badge_text') }}" type="text"
                        id="form-badge-text" layout="layout-badge" element="span" class-name="badge-text"
                        bound-attr="text/html" set="append-once">
                </div>
                <div class="form-item demo-attribute">
                    <label for="form-compare-tags">compare tags</label>
                    <textarea name="{{ ModelMetaKey::COMPARE_TAGS }}" id="form-compare-tags" cols="20" rows="2"
                        layout="layout-compare-tags" element="span" set="line-separated" class-name="compare-tag"
                        bound-attr="multiple-text/html">{{ old(ModelMetaKey::COMPARE_TAGS) }}</textarea>
                </div>
                <div class="form-item demo-attribute">
                    <label for="form-regular-price">regular price</label>
                    <input name="{{ ModelMetaKey::REGULAR_PRICE }}" value="{{ old(ModelMetaKey::REGULAR_PRICE) }}"
                        type="text" id="form-regular-price" layout="layout-regular-price" element="span"
                        class-name="regular-price" bound-attr="text/html">
                </div>
                <div class="form-item demo-attribute">
                    <label for="form-price">price</label>
                    <input name="{{ ModelMetaKey::PRICE }}" value="{{ old(ModelMetaKey::PRICE) }}" type="text"
                        id="form-price" layout="layout-price" element="span" class-name="price" bound-attr="text/html">
                </div>
                <div class="form-item demo-attribute">
                    <label for="form-gift">gift</label>
                    <input name="{{ ModelMetaKey::GIFT }}" value="{{ old(ModelMetaKey::GIFT) }}" type="text"
                        id="form-gift" layout="layout-gift" element="span" class-name="gift" bound-attr="text/html">
                </div>

                <button type="button" id="btn-demo-change" class="btn btn-demo-change">Demo changes</button>
            </div>
            <div class="layout-demo-product">
                <x-product.list.index>
                    <x-product.card.index :product="$product ?? null" :url="null" />
                </x-product.list.index>
                <div class="layout-demo-product-meta">
                    <div class="form-item demo-attribute-to-table-product-meta">
                        <label for="form-meta-key">meta key</label>
                        <select name="meta_key" id="form-meta-key">
                            @foreach (ModelMetaKey::notShownInCardCases() as $metaKey)
                                @if (str_starts_with($metaKey, 'product_attr_'))
                                    <option value="{{ $metaKey }}">{{ $metaKey }}</option>
                                @endif
                            @endforeach
                        </select>
                        <br>
                        <label for="form-meta-value">meta value</label>
                        <input name="meta_value" value="{{ old('meta_value') }}" type="text" id="form-meta-value">
                        <button type="button" class="btn btn-add">add</button>
                    </div>
                    <table class="table-product-meta">
                        <thead>
                            <tr>
                                <th>Key</th>
                                <th>Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (ModelMetaKey::notShownInCardCases() as $metaKey)
                                @if (old($metaKey))
                                    <tr>
                                        <td class="meta-key">{{ $metaKey }}</td>
                                        <td class="meta-value">{{ old($metaKey) }}</td>
                                        <input type="hidden" name="{{ $metaKey }}" value="{{ old($metaKey) }}">
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="layout-demo-product-term">
                <div class="demo-attribute-to-table-product-term-taxonomy">
                    <label for="form-term-taxonomy">term (taxonomy)</label>
                    <select name="term_taxonomy" id="form-term-taxonomy">
                        <option value=""></option>
                        @foreach ($termTaxonomies as $termTaxonomy)
                            <option value="{{ $termTaxonomy->id }}">
                                {{ $termTaxonomy->term->name . ' (' . $termTaxonomy->taxonomy . ')' }}</option>
                        @endforeach
                    </select>
                    <button type="button" class="btn btn-add">add</button>
                </div>
                <table class="table-product-term-taxonomy">
                    <thead>
                        <tr>
                            <th>Term (taxonomy)</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <input type="hidden" name="term_taxonomy_ids" />
            </div>
        </div>
        <button id="create_product">Create Product</button>
        @foreach ($errors->all() as $error)
            <span class="error">{{ $error }}</span>
            <br>
        @endforeach
    </form>
@endsection

@section('scripts')
    @parent
    @vite($viewsDir . '/admin/products/create-edit.js')
@endsection
