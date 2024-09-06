@extends('layouts.admin.index')
@section('title', 'Edit Product')

@section('styles')
    @parent
    @vite($viewsDir . '/admin/products/create-edit.css')
@endsection
@use('App\Enums\ModelMetaKey')
@section('content')
    <!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
    <form method="POST" action="{{ route('admin.products.update', $product->slug) }}">
        @csrf
        @method('patch')
        <div class="page-create-edit-product">
            <div class="form-item layout-form">
                <div class="form-item">
                    <label for="form-type">type</label>
                    <select name="type" id="form-type">
                        @if (old('type'))
                            <option value="{{ old('type') }}">{{ old('type') }}</option>
                        @endif
                        @if ($product->type)
                            <option value="{{ $product->type }}">{{ $product->type }}</option>
                        @endif
                        @foreach ($productTypesEnum as $productType)
                            @if ($productType !== $product->type && $productType !== old('type'))
                                <option value="{{ $productType }}">{{ $productType }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-item">
                    <label for="form-parent-id">parent product</label>
                    <select name="parent_id" class-name="parent-id" id="parent_id"
                        value="{{ old('parent_id') ?? $product->parent_id }}">
                        <option value=""></option>
                    </select>
                </div>
                <div class="form-item">
                    <label for="form-status">status</label>
                    <select name="status" id="form-status">
                        @if (old('status'))
                            <option value="{{ old('status') }}">{{ old('status') }}</option>
                        @endif
                        @if ($product->status)
                            <option value="{{ $product->status }}">{{ $product->status }}</option>
                        @endif
                        @foreach ($productStatusesEnum as $productStatus)
                            @if ($productStatus !== $product->status && $productStatus !== old('status'))
                                <option value="{{ $productStatus }}">{{ $productStatus }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-item demo-attribute">
                    @php
                        $text = '';
                        if (isset(get_meta($productMeta, ModelMetaKey::TOP_TAGS)->value)) {
                            foreach (unserialize(get_meta($productMeta, ModelMetaKey::TOP_TAGS)->value) as $topTag) {
                                $text .= "$topTag\n";
                            }
                        }

                        $text = old(ModelMetaKey::TOP_TAGS) ?? $text;
                    @endphp
                    <label for="form-top-tags">top tags</label>
                    <textarea name="{{ ModelMetaKey::TOP_TAGS }}" id="form-top-tags" cols="20" rows="2" layout="layout-top-tags"
                        element="span" class-name="top-tag" bound-attr="multiple-text/html" set="line-separated">{{ $text }}</textarea>
                </div>
                <div class="form-item demo-attribute">
                    <label for="form-title">title</label>
                    <input name="title" value="{{ old('title') ?? $product->title }}" type="text" id="form-title"
                        layout="holder-product-name" element="span" class-name="product-name" bound-attr="text/html">
                </div>
                <div class="form-item">
                    <label for="form-slug">slug</label>
                    <input name="slug" value="{{ old('slug') ?? $product->slug }}" type="text" id="form-slug">
                </div>
                <div class="form-item demo-attribute">
                    <label for="form-thumb-url">thumb url</label>
                    <input name="{{ ModelMetaKey::THUMB_URL }}"
                        value="{{ old(ModelMetaKey::THUMB_URL) ?? (get_meta($productMeta, ModelMetaKey::THUMB_URL)->value ?? null) }}"
                        type="text" id="form-thumb-url" layout="holder-img" element="img" class-name="thumb"
                        bound-attr="src" set="append-once">
                </div>
                <div class="form-item demo-attribute">
                    <label for="form-bottom-left-stamp-url">bottom-left stamp url</label>
                    <input name="{{ ModelMetaKey::BOTTOM_LEFT_STAMP_URL }}"
                        value="{{ old(ModelMetaKey::BOTTOM_LEFT_STAMP_URL) ?? (get_meta($productMeta, ModelMetaKey::BOTTOM_LEFT_STAMP_URL)->value ?? null) }}"
                        type="text" id="form-bottom-left-stamp-url" layout="holder-img" element="img"
                        class-name="stamp bottom-left" bound-attr="src" set="append-once">
                </div>
                <div class="form-item demo-attribute">
                    <label for="form-badge-icon">badge icon url</label>
                    <input name="product_attr_badge_icon_url"
                        value="{{ old('product_attr_badge_icon_url') ?? isset(get_meta($productMeta, ModelMetaKey::BADGE)->value)
                            ? unserialize(get_meta($productMeta, ModelMetaKey::BADGE)->value)['product_attr_badge_icon_url']
                            : null }}"
                        type="text" id="form-badge-icon" layout="layout-badge" element="img" class-name="badge"
                        bound-attr="src" set="append-once">
                </div>
                <div class="form-item demo-attribute">
                    <label for="form-badge-background">badge background</label>
                    <input name="product_attr_badge_background"
                        value="{{ old('product_attr_badge_background') ?? isset(get_meta($productMeta, ModelMetaKey::BADGE)->value)
                            ? unserialize(get_meta($productMeta, ModelMetaKey::BADGE)->value)['product_attr_badge_background']
                            : null }}"
                        id="form-badge-layout" type="text" layout="layout-badge" bound-attr="class"
                        default-value="layout-badge" placeholder="bg1, bg2, bg3, bg4..." set="append-once">
                </div>
                <div class="form-item demo-attribute">
                    <label for="form-title">badge text</label>
                    <input name="product_attr_badge_text"
                        value="{{ old('product_attr_badge_text') ?? isset(get_meta($productMeta, ModelMetaKey::BADGE)->value)
                            ? unserialize(get_meta($productMeta, ModelMetaKey::BADGE)->value)['product_attr_badge_text']
                            : null }}"
                        type="text" id="form-badge-text" layout="layout-badge" element="span"
                        class-name="badge-text" bound-attr="text/html" set="append-once">
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
                        bound-attr="multiple-text/html">{{ $text }}</textarea>
                </div>
                <div class="form-item demo-attribute">
                    <label for="form-regular-price">regular price</label>
                    <input name="{{ ModelMetaKey::REGULAR_PRICE }}"
                        value="{{ old(ModelMetaKey::REGULAR_PRICE) ?? isset(get_meta($productMeta, ModelMetaKey::REGULAR_PRICE)->value)
                            ? get_meta($productMeta, ModelMetaKey::REGULAR_PRICE)->value
                            : null }}"
                        type="text" id="form-regular-price" layout="layout-regular-price" element="span"
                        class-name="regular-price" bound-attr="text/html">
                </div>
                <div class="form-item demo-attribute">
                    <label for="form-price">price</label>
                    <input name="{{ ModelMetaKey::PRICE }}"
                        value="{{ old(ModelMetaKey::PRICE) ?? isset(get_meta($productMeta, ModelMetaKey::PRICE)->value)
                            ? get_meta($productMeta, ModelMetaKey::PRICE)->value
                            : null }}"
                        type="text" id="form-price" layout="layout-price" element="span" class-name="price"
                        bound-attr="text/html">
                </div>
                <div class="form-item demo-attribute">
                    <label for="form-gift">gift</label>
                    <input name="{{ ModelMetaKey::GIFT }}"
                        value="{{ old(ModelMetaKey::GIFT) ?? isset(get_meta($productMeta, ModelMetaKey::GIFT)->value)
                            ? get_meta($productMeta, ModelMetaKey::GIFT)->value
                            : null }}"
                        type="text" id="form-gift" layout="layout-gift" element="span" class-name="gift"
                        bound-attr="text/html">
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
                        <select id="form-meta-key">
                            @foreach (ModelMetaKey::notShownInCardCases() as $metaKey)
                                @if (str_starts_with($metaKey, 'product_attr_'))
                                    <option value="{{ $metaKey }}">{{ $metaKey }}</option>
                                @endif
                            @endforeach
                        </select>
                        <br>
                        <label for="form-meta-value">meta value</label>
                        <input type="text" id="form-meta-value">
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
                            @foreach ($productMeta as $meta)
                                @if (in_array($meta->key, ModelMetaKey::notShownInCardCases()))
                                    <tr>
                                        <td class="meta-key">{{ $meta->key }}</td>
                                        <td class="meta-value">{{ $meta->value }}</td>
                                        <input type="hidden" name="{{ $meta->key }}" value="{{ $meta->value }}">
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
                        @foreach ($productTermTaxonomies as $productTermTaxonomy)
                            <tr>
                                <td class="term-taxonomy">
                                    {{ $productTermTaxonomy->term->name . ' (' . $productTermTaxonomy->taxonomy . ')' }}
                                    <button type="button" class="btn btn-remove">X</button>
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
        </div>
        <button type="submit">Update Product</button>
        @foreach ($errors->all() as $error)
            <span class="error">{{ $error }}</span>
            <br>
        @endforeach
    </form>
    <form method="POST" action="{{ route('admin.products.copy', $product->slug) }}">
        @csrf
        <button>Make a copy</button>
    </form>
@endsection

@section('scripts')
    @parent
    @vite($viewsDir . '/admin/products/create-edit.js')
@endsection
