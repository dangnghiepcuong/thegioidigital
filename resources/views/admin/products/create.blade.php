@extends('layouts.admin.index')
@section('title', 'Create Product')

@section('styles')
    @parent
    @vite($viewsDir . '/admin/products/create-edit.css')
    @vite($viewsDir . '/components/product/card/index.css')
@endsection
@use('App\Enums\ModelMetaKey')
@section('content')
    <!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
    <div class="page-create-product">
        <div class="layout-editing-sections">
            <form id="form-create-product" method="POST" action="{{ route('admin.products.store') }}">
                @csrf
                <div class="section" for="layout-basic-info">
                    Basic Information
                    <span class="icon material-symbols-outlined">add</span>
                </div>
                <div class="section-content layout-basic-info" id="layout-basic-info">
                    <div class="form-item demo-attribute">
                        <label for="form-title">title</label>
                        <input name="title" value="{{ old('title') }}" class="input-field" type="text" id="form-title"
                            layout="holder-product-name" element="span" class-name="product-name" bound-attr="text/html">
                    </div>
                    <div class="form-item">
                        <label for="form-slug">slug</label>
                        <input name="slug" value="{{ old('slug') }}" type="text" id="form-slug" class="input-field">
                    </div>
                    <div class="form-item">
                        <label for="form-type">type</label>
                        <div class="select-multiple input-field">
                            @if (old('type'))
                                <div class="select-item">
                                    <input name="type" type="radio" value="{{ old('type') }}"
                                        id="{{ old('type') }}" checked>
                                    <label class="label-radio" for="{{ old('type') }}">{{ old('type') }}</label>
                                </div>
                            @endif
                            @foreach ($productTypesEnum as $productType)
                                @if ($productType !== old('type'))
                                    <div class="select-item">
                                        <input name="type" type="radio" value="{{ $productType }}"
                                            id="{{ $productType }}">
                                        <label class="label-radio" for="{{ $productType }}">{{ $productType }}</label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="form-item">
                        <label for="form-parent-id">parent product</label>
                        <select name="parent_id" class-name="parent-id" id="parent_id" value="{{ old('parent_id') }}"
                            class="input-field">
                            <option value=""></option>
                        </select>
                    </div>
                    <div class="form-item">
                        <label for="form-status">status</label>
                        <div class="select-multiple input-field" id="form-status">
                            @if (old('status'))
                                <div class="select-item">
                                    <input name="status" type="radio" value="{{ old('status') }}"
                                        id="{{ old('status') }}" checked>
                                    <label class="label-radio" for="{{ old('status') }}">{{ old('status') }}</label>
                                </div>
                            @endif
                            @foreach ($productStatusesEnum as $productStatus)
                                @if ($productStatus !== old('status'))
                                    <div class="select-item">
                                        <input name="status" type="radio" value="{{ $productStatus }}"
                                            id="{{ $productStatus }}">
                                        <label class="label-radio" for="{{ $productStatus }}">{{ $productStatus }}</label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="form-item demo-attribute">
                        <label for="form-top-tags">top tags</label>
                        <textarea name="{{ ModelMetaKey::TOP_TAGS }}" id="form-top-tags" cols="20" rows="2" layout="layout-top-tags"
                            element="span" class-name="top-tag" bound-attr="multiple-text/html" set="line-separated" class="input-field"></textarea>
                    </div>
                    <div class="form-item demo-attribute">
                        <label for="form-thumb-url">thumb url</label>
                        <input name="{{ ModelMetaKey::THUMB_URL }}" value="{{ old(ModelMetaKey::THUMB_URL) }}"
                            type="text" id="form-thumb-url" layout="holder-img" element="img" class-name="thumb"
                            bound-attr="src" set="append-once" class="input-field">
                    </div>
                    <div class="form-item demo-attribute">
                        <label for="form-bottom-left-stamp-url">bottom-left stamp url</label>
                        <input name="{{ ModelMetaKey::BOTTOM_LEFT_STAMP_URL }}"
                            value="{{ old(ModelMetaKey::BOTTOM_LEFT_STAMP_URL) }}" type="text"
                            id="form-bottom-left-stamp-url" layout="holder-img" element="img"
                            class-name="stamp bottom-left" bound-attr="src" set="append-once" class="input-field">
                    </div>
                    <div class="form-item demo-attribute">
                        <label for="form-top-right-stamp-url">top-right stamp url</label>
                        <input name="{{ ModelMetaKey::TOP_RIGHT_STAMP_URL }}"
                            value="{{ old(ModelMetaKey::TOP_RIGHT_STAMP_URL) }}" type="text"
                            id="form-top-right-stamp-url" layout="holder-img" element="img"
                            class-name="stamp top-right" bound-attr="src" set="append-once" class="input-field">
                    </div>
                    <div class="form-item demo-attribute">
                        <label for="form-badge-icon">badge icon url</label>
                        <input name="product_attr_badge_icon_url" value="{{ old('product_attr_badge_icon_url') }}"
                            type="text" id="form-badge-icon" layout="layout-badge" element="img" class-name="badge"
                            bound-attr="src" set="append-once" class="input-field">
                    </div>
                    <div class="form-item demo-attribute">
                        <label for="form-badge-background">badge background</label>
                        <input name="product_attr_badge_background" value="{{ old('product_attr_badge_background') }}"
                            id="form-badge-layout" type="text" layout="layout-badge" bound-attr="class"
                            default-value="layout-badge" placeholder="bg1, bg2, bg3, bg4..." set="append-once"
                            class="input-field">
                    </div>
                    <div class="form-item demo-attribute">
                        <label for="form-title">badge text</label>
                        <input name="product_attr_badge_text" value="{{ old('product_attr_badge_text') }}"
                            type="text" id="form-badge-text" layout="layout-badge" element="span"
                            class-name="badge-text" bound-attr="text/html" set="append-once" class="input-field">
                    </div>
                    <div class="form-item demo-attribute">
                        <label for="form-compare-tags">compare tags</label>
                        <textarea name="{{ ModelMetaKey::COMPARE_TAGS }}" id="form-compare-tags" cols="20" rows="2"
                            layout="layout-compare-tags" element="span" set="line-separated" class-name="compare-tag"
                            bound-attr="multiple-text/html" class="input-field"></textarea>
                    </div>
                    <div class="form-item demo-attribute">
                        <label for="form-regular-price">regular price</label>
                        <input name="{{ ModelMetaKey::REGULAR_PRICE }}" value="{{ old(ModelMetaKey::REGULAR_PRICE) }}"
                            type="text" id="form-regular-price" layout="layout-regular-price" element="span"
                            class-name="regular-price" bound-attr="text/html" class="input-field">
                    </div>
                    <div class="form-item demo-attribute">
                        <label for="form-price">price</label>
                        <input name="{{ ModelMetaKey::PRICE }}" value="{{ old(ModelMetaKey::PRICE) }}" type="text"
                            id="form-price" layout="layout-price" element="span" class-name="price"
                            bound-attr="text/html" class="input-field">
                    </div>
                    <div class="form-item demo-attribute">
                        <label for="form-gift">gift</label>
                        <input name="{{ ModelMetaKey::GIFT }}" value="{{ old(ModelMetaKey::GIFT) }}" type="text"
                            id="form-gift" layout="layout-gift" element="span" class-name="gift" bound-attr="text/html"
                            class="input-field">
                    </div>
                    <div class="layout-btn-demo">
                        <div class="item-btn" id="btn-demo-change">
                            Demo
                            <span class="icon material-symbols-outlined">done_all</span>
                        </div>
                    </div>
                </div>

                <div class="section" for="layout-wysiwyg-product-description">
                    Product Description
                    <span class="icon material-symbols-outlined">add</span>
                </div>
                <div class="section-content layout-wysiwyg-product-description" id="layout-wysiwyg-product-description">
                    <div id="wysiwyg-product-description">
                        {!! old('description') !!}
                    </div>
                    <input type="hidden" name="description" value="{{ old('description') }}">
                    <div class="layout-btn-demo">
                        <div class="item-btn" id="btn-demo-product-description">
                            Demo
                            <span class="icon material-symbols-outlined">done_all</span>
                        </div>
                    </div>
                </div>

                <div class="section" for="layout-meta-data">
                    Meta Data
                    <span class="icon material-symbols-outlined">add</span>
                </div>
                <div class="section-content layout-meta-data" id="layout-meta-data">
                    <div class="form-item demo-attribute-to-table-product-meta">
                        <label for="form-meta-key">meta key</label>
                        <select id="form-meta-key">
                            @foreach (ModelMetaKey::notShownInCardCases() as $metaKey)
                                @if (str_starts_with($metaKey, 'product_attr_'))
                                    <option value="{{ $metaKey }}">{{ $metaKey }}</option>
                                @endif
                            @endforeach
                        </select>
                        <label for="form-meta-value">meta value</label>
                        <input type="text" id="form-meta-value">
                        <span class="icon material-symbols-outlined btn-add">add</span>
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
                                        <td class="meta-value">
                                            {{ old($metaKey) }}
                                            <span class="icon material-symbols-outlined btn-remove">close</span>
                                        </td>
                                        <input type="hidden" name="{{ $metaKey }}" value="{{ old($metaKey) }}">
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="section" for="layout-term-taxonomy">
                    Terminology & Taxonomy
                    <span class="icon material-symbols-outlined">add</span>
                </div>
                <div class="section-content layout-term-taxonomy" id="layout-term-taxonomy">
                    <div class="form-item demo-attribute-to-table-product-term-taxonomy">
                        <label for="form-term-taxonomy">term (taxonomy)</label>
                        <select name="term_taxonomy" id="form-term-taxonomy">
                            <option value=""></option>
                            @foreach ($termTaxonomies as $termTaxonomy)
                                <option value="{{ $termTaxonomy->id }}">
                                    {{ $termTaxonomy->term->name . ' (' . $termTaxonomy->taxonomy . ')' }}</option>
                            @endforeach
                        </select>
                        <span class="icon material-symbols-outlined btn-add">add</span>
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
                    <input type="hidden" name="term_taxonomy_ids" value="" />
                </div>
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
    <div class="popup-demo-description layout-popup">
        <a class="btn-close" onclick="popupPanel('close')">
            <span class="icon material-symbols-outlined">close</span>
            <span>Đóng</span>
        </a>
        <div id="layout-demo-product-description" class="layout-demo-product-description ck-content">
            {!! old('description') !!}
        </div>
    </div>
    <div class="layer-shadow-overlay"></div>
@endsection

@section('scripts')
    @parent
    @vite($viewsDir . '/admin/products/create-edit-ui-interaction.js')
    @vite($viewsDir . '/admin/products/create-edit-server-interaction.js')
    @vite($viewsDir . '/admin/products/wysiwyg.js')
@endsection
