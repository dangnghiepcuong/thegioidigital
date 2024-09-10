@extends('layouts.admin.index')
@section('title', 'Edit Product')

@section('styles')
    @parent
    @vite($viewsDir . '/admin/products/edit.css')
    @vite($viewsDir . '/components/product/card/index.css')
@endsection
@use('App\Enums\ModelMetaKey')
@section('content')
    <!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->

    <div class="page-edit-product">
        <div class="layout-editing-fields">
            <form id="form-update-product" method="POST" action="{{ route('admin.products.update', $product->slug) }}">
                @csrf
                @method('patch')
                <div class="section" for="layout-basic-info">
                    Basic Information
                    <span class="icon material-symbols-outlined">add</span>
                </div>
                <div class="section-content layout-basic-info" id="layout-basic-info">
                    <div class="form-item demo-attribute">
                        <label for="form-title">title</label>
                        <input name="title" value="{{ old('title') ?? $product->title }}" class="input-field"
                            type="text" id="form-title" layout="holder-product-name" element="span"
                            class-name="product-name" bound-attr="text/html">
                    </div>
                    <div class="form-item">
                        <label for="form-slug">slug</label>
                        <input name="slug" value="{{ old('slug') ?? $product->slug }}" type="text" id="form-slug"
                            class="input-field">
                    </div>
                    <div class="form-item">
                        <label for="form-type">type</label>
                        <div class="select-multiple input-field">
                            @if ($product->type)
                                <div class="select-item">
                                    <input name="type" type="radio" value="{{ $product->type }}"
                                        id="{{ $product->type }}" checked>
                                    <label class="label-radio" for="{{ $product->type }}">{{ $product->type }}</label>
                                </div>
                            @endif
                            @if (old('type'))
                                <div class="select-item">
                                    <input name="type" type="radio" value="{{ old('type') }}"
                                        id="{{ old('type') }}" checked>
                                    <label class="label-radio" for="{{ old('type') }}">{{ old('type') }}</label>
                                </div>
                            @endif
                            @foreach ($productTypesEnum as $productType)
                                @if ($productType !== $product->type && $productType !== old('type'))
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
                        <select name="parent_id" class-name="parent-id" id="parent_id"
                            value="{{ old('parent_id') ?? $product->parent_id }}" class="input-field">
                            <option value=""></option>
                        </select>
                    </div>
                    <div class="form-item">
                        <label for="form-status">status</label>
                        <div class="select-multiple input-field" id="form-status">
                            @if ($product->status)
                                <div class="select-item">
                                    <input name="status" type="radio" value="{{ $product->status }}"
                                        id="{{ $product->status }}" checked>
                                    <label class="label-radio" for="{{ $product->status }}">{{ $product->status }}</label>
                                </div>
                            @endif
                            @if (old('status'))
                                <div class="select-item">
                                    <input name="status" type="radio" value="{{ old('status') }}"
                                        id="{{ old('status') }}" checked>
                                    <label class="label-radio" for="{{ old('status') }}">{{ old('status') }}</label>
                                </div>
                            @endif
                            @foreach ($productStatusesEnum as $productStatus)
                                @if ($productStatus !== $product->status && $productStatus !== old('status'))
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
                        @php
                            $text = '';
                            if (isset(get_meta($productMeta, ModelMetaKey::TOP_TAGS)->value)) {
                                foreach (
                                    unserialize(get_meta($productMeta, ModelMetaKey::TOP_TAGS)->value)
                                    as $topTag
                                ) {
                                    $text .= "$topTag\n";
                                }
                            }

                            $text = old(ModelMetaKey::TOP_TAGS) ?? $text;
                        @endphp
                        <label for="form-top-tags">top tags</label>
                        <textarea name="{{ ModelMetaKey::TOP_TAGS }}" id="form-top-tags" cols="20" rows="2" layout="layout-top-tags"
                            element="span" class-name="top-tag" bound-attr="multiple-text/html" set="line-separated" class="input-field">{{ $text }}</textarea>
                    </div>
                    <div class="form-item demo-attribute">
                        <label for="form-thumb-url">thumb url</label>
                        <input name="{{ ModelMetaKey::THUMB_URL }}"
                            value="{{ old(ModelMetaKey::THUMB_URL) ?? (get_meta($productMeta, ModelMetaKey::THUMB_URL)->value ?? null) }}"
                            type="text" id="form-thumb-url" layout="holder-img" element="img" class-name="thumb"
                            bound-attr="src" set="append-once" class="input-field">
                    </div>
                    <div class="form-item demo-attribute">
                        <label for="form-bottom-left-stamp-url">bottom-left stamp url</label>
                        <input name="{{ ModelMetaKey::BOTTOM_LEFT_STAMP_URL }}"
                            value="{{ old(ModelMetaKey::BOTTOM_LEFT_STAMP_URL) ?? (get_meta($productMeta, ModelMetaKey::BOTTOM_LEFT_STAMP_URL)->value ?? null) }}"
                            type="text" id="form-bottom-left-stamp-url" layout="holder-img" element="img"
                            class-name="stamp bottom-left" bound-attr="src" set="append-once" class="input-field">
                    </div>
                    <div class="form-item demo-attribute">
                        <label for="form-top-right-stamp-url">top-right stamp url</label>
                        <input name="{{ ModelMetaKey::TOP_RIGHT_STAMP_URL }}"
                            value="{{ old(ModelMetaKey::TOP_RIGHT_STAMP_URL) ?? (get_meta($productMeta, ModelMetaKey::TOP_RIGHT_STAMP_URL)->value ?? null) }}"
                            type="text" id="form-top-right-stamp-url" layout="holder-img" element="img"
                            class-name="stamp top-right" bound-attr="src" set="append-once" class="input-field">
                    </div>
                    <div class="form-item demo-attribute">
                        <label for="form-badge-icon">badge icon url</label>
                        <input name="product_attr_badge_icon_url"
                            value="{{ old('product_attr_badge_icon_url') ?? isset(get_meta($productMeta, ModelMetaKey::BADGE)->value)
                                ? unserialize(get_meta($productMeta, ModelMetaKey::BADGE)->value)['product_attr_badge_icon_url']
                                : null }}"
                            type="text" id="form-badge-icon" layout="layout-badge" element="img" class-name="badge"
                            bound-attr="src" set="append-once" class="input-field">
                    </div>
                    <div class="form-item demo-attribute">
                        <label for="form-badge-background">badge background</label>
                        <input name="product_attr_badge_background"
                            value="{{ old('product_attr_badge_background') ?? isset(get_meta($productMeta, ModelMetaKey::BADGE)->value)
                                ? unserialize(get_meta($productMeta, ModelMetaKey::BADGE)->value)['product_attr_badge_background']
                                : null }}"
                            id="form-badge-layout" type="text" layout="layout-badge" bound-attr="class"
                            default-value="layout-badge" placeholder="bg1, bg2, bg3, bg4..." set="append-once"
                            class="input-field">
                    </div>
                    <div class="form-item demo-attribute">
                        <label for="form-title">badge text</label>
                        <input name="product_attr_badge_text"
                            value="{{ old('product_attr_badge_text') ?? isset(get_meta($productMeta, ModelMetaKey::BADGE)->value)
                                ? unserialize(get_meta($productMeta, ModelMetaKey::BADGE)->value)['product_attr_badge_text']
                                : null }}"
                            type="text" id="form-badge-text" layout="layout-badge" element="span"
                            class-name="badge-text" bound-attr="text/html" set="append-once" class="input-field">
                    </div>
                    <div class="form-item demo-attribute">
                        @php
                            $text = '';
                            if (isset(get_meta($productMeta, ModelMetaKey::COMPARE_TAGS)->value)) {
                                foreach (
                                    unserialize(get_meta($productMeta, ModelMetaKey::COMPARE_TAGS)->value)
                                    as $compareTag
                                ) {
                                    $text .= "$compareTag\n";
                                }
                            }

                            $text = old(ModelMetaKey::COMPARE_TAGS) ?? $text;
                        @endphp
                        <label for="form-compare-tags">compare tags</label>
                        <textarea name="{{ ModelMetaKey::COMPARE_TAGS }}" id="form-compare-tags" cols="20" rows="2"
                            layout="layout-compare-tags" element="span" set="line-separated" class-name="compare-tag"
                            bound-attr="multiple-text/html" class="input-field">{{ $text }}</textarea>
                    </div>
                    <div class="form-item demo-attribute">
                        <label for="form-regular-price">regular price</label>
                        <input name="{{ ModelMetaKey::REGULAR_PRICE }}"
                            value="{{ old(ModelMetaKey::REGULAR_PRICE) ?? isset(get_meta($productMeta, ModelMetaKey::REGULAR_PRICE)->value)
                                ? get_meta($productMeta, ModelMetaKey::REGULAR_PRICE)->value
                                : null }}"
                            type="text" id="form-regular-price" layout="layout-regular-price" element="span"
                            class-name="regular-price" bound-attr="text/html" class="input-field">
                    </div>
                    <div class="form-item demo-attribute">
                        <label for="form-price">price</label>
                        <input name="{{ ModelMetaKey::PRICE }}"
                            value="{{ old(ModelMetaKey::PRICE) ?? isset(get_meta($productMeta, ModelMetaKey::PRICE)->value)
                                ? get_meta($productMeta, ModelMetaKey::PRICE)->value
                                : null }}"
                            type="text" id="form-price" layout="layout-price" element="span" class-name="price"
                            bound-attr="text/html" class="input-field">
                    </div>
                    <div class="form-item demo-attribute">
                        <label for="form-gift">gift</label>
                        <input name="{{ ModelMetaKey::GIFT }}"
                            value="{{ old(ModelMetaKey::GIFT) ?? isset(get_meta($productMeta, ModelMetaKey::GIFT)->value)
                                ? get_meta($productMeta, ModelMetaKey::GIFT)->value
                                : null }}"
                            type="text" id="form-gift" layout="layout-gift" element="span" class-name="gift"
                            bound-attr="text/html" class="input-field">
                    </div>
                    <div class="layout-btn-demo-change">
                        <div class="item-btn" id="btn-demo-change">
                            Changes
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
                            @foreach ($productMeta as $meta)
                                @if (in_array($meta->key, ModelMetaKey::notShownInCardCases()))
                                    <tr>
                                        <td class="meta-key">{{ $meta->key }}</td>
                                        <td class="meta-value">
                                            {{ $meta->value }}
                                            <span class="icon material-symbols-outlined btn-remove">close</span>
                                        </td>
                                        <input type="hidden" name="{{ $meta->key }}" value="{{ $meta->value }}">
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
                            @foreach ($productTermTaxonomies as $productTermTaxonomy)
                                <tr>
                                    <td class="term-taxonomy">
                                        {{ $productTermTaxonomy->term->name . ' (' . $productTermTaxonomy->taxonomy . ')' }}
                                        <span class="icon material-symbols-outlined btn-remove">close</span>
                                        <input type="hidden" name="term_taxonomy_id"
                                            value="{{ $productTermTaxonomy->id }}">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <input type="hidden" name="term_taxonomy_ids"
                        value="{{ implode("\n", $productTermTaxonomies->pluck('id')->toArray()) }}" />
                </div>
            </form>
        </div>
        <div class="layout-demo-product">
            <x-product.card.index :product="$product ?? null" :url="null" />
            <div class="layout-action-buttons">
                <div class="item-btn" id="btn-submit-form-update-product">
                    Save
                    <span class="icon material-symbols-outlined">save</span>
                </div>
                <form id="form-copy-product" method="POST" action="{{ route('admin.products.copy', $product->slug) }}">
                    <div class="item-btn" id="btn-submit-form-copy-product">
                        @csrf
                        Copy
                        <span class="icon material-symbols-outlined">content_copy</span>
                    </div>
                </form>
            </div>
            @foreach ($errors->all() as $error)
                <span class="error">{{ $error }}</span>
                <br>
            @endforeach
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    @vite($viewsDir . '/admin/products/create-edit.js')
    @vite($viewsDir . '/admin/products/edit.js')
@endsection
