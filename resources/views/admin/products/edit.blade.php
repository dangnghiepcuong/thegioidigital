@extends('layouts.admin.index')
@section('title', 'Edit Product')

@section('styles')
    @parent
    @vite($viewsDir . '/admin/products/create-edit.css')
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
                <div class="form-item demo-attribute">
                    <label for="form-title">{{ __('product.title') }}</label>
                    <input name="title" value="{{ old('title') ?? $product->title }}" class="input-field" type="text"
                        id="form-title" layout="holder-product-name" element="span" class-name="product-name"
                        bound-attr="text/html">
                </div>
                <div class="form-item">
                    <label for="form-slug">{{ __('product.slug') }}</label>
                    <input name="slug" value="{{ old('slug') ?? $product->slug }}" type="text" id="form-slug"
                        class="input-field">
                </div>
                <div class="form-item">
                    <label for="form-type">{{ __('product.type') }}</label>
                    <div class="select-multiple input-field">
                        @if ($product->type && !old('type'))
                            <div class="select-item">
                                <input name="type" type="radio" value="{{ $product->type }}" id="{{ $product->type }}"
                                    checked>
                                <label class="label-radio" for="{{ $product->type }}">{{ $product->type }}</label>
                            </div>
                        @endif
                        @if (old('type'))
                            <div class="select-item">
                                <input name="type" type="radio" value="{{ old('type') }}" id="{{ old('type') }}"
                                    checked>
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
                    <label for="form-parent-id">{{ __('product.parent_product') }}</label>
                    <select name="parent_id" class-name="parent-id" id="parent_id"
                        value="{{ old('parent_id') ?? $product->parent_id }}" class="input-field">
                        <option value=""></option>
                    </select>
                </div>
                <div class="form-item">
                    <label for="form-status">{{ __('product.status.status') }}</label>
                    <div class="select-multiple input-field" id="form-status">
                        @if ($product->status && !old('status'))
                            <div class="select-item">
                                <input name="status" type="radio" value="{{ $product->status }}"
                                    id="{{ $product->status }}" checked>
                                <label class="label-radio"
                                    for="{{ $product->status }}">{{ __("product.status.$product->status") }}</label>
                            </div>
                        @endif
                        @if (old('status'))
                            <div class="select-item">
                                <input name="status" type="radio" value="{{ old('status') }}" id="{{ old('status') }}"
                                    checked>
                                <label class="label-radio"
                                    for="{{ old('status') }}">{{ __('product.status.' . old('status')) }}</label>
                            </div>
                        @endif
                        @foreach ($productStatusesEnum as $productStatus)
                            @if ($productStatus !== $product->status && $productStatus !== old('status'))
                                <div class="select-item">
                                    <input name="status" type="radio" value="{{ $productStatus }}"
                                        id="{{ $productStatus }}">
                                    <label class="label-radio"
                                        for="{{ $productStatus }}">{{ __("product.status.$productStatus") }}</label>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="section" for="layout-basic-info">
                    {{ __('product.basic_information') }}
                    <span class="icon material-symbols-outlined">add</span>
                </div>
                <div class="section-content layout-basic-info" id="layout-basic-info">
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
                        <label for="form-top-tags">{{ __('product_meta.product_attr_top_tags') }}</label>
                        <textarea name="{{ ModelMetaKey::TOP_TAGS }}" id="form-top-tags" cols="20" rows="2" layout="layout-top-tags"
                            element="span" class-name="top-tag" bound-attr="multiple-text/html" set="line-separated" class="input-field">{{ $text }}</textarea>
                    </div>
                    <div class="form-item demo-attribute">
                        <label for="form-thumb-url">{{ __('product_meta.product_attr_thumb_url') }}</label>
                        <input name="{{ ModelMetaKey::THUMB_URL }}"
                            value="{{ old(ModelMetaKey::THUMB_URL) ?? (get_meta($productMeta, ModelMetaKey::THUMB_URL)->value ?? null) }}"
                            type="text" id="form-thumb-url" layout="holder-img" element="img" class-name="thumb"
                            bound-attr="src" set="append-once" class="input-field">
                    </div>
                    <div class="form-item demo-attribute">
                        <label
                            for="form-bottom-left-stamp-url">{{ __('product_meta.product_attr_bottom_left_stamp_url') }}</label>
                        <input name="{{ ModelMetaKey::BOTTOM_LEFT_STAMP_URL }}"
                            value="{{ old(ModelMetaKey::BOTTOM_LEFT_STAMP_URL) ?? (get_meta($productMeta, ModelMetaKey::BOTTOM_LEFT_STAMP_URL)->value ?? null) }}"
                            type="text" id="form-bottom-left-stamp-url" layout="holder-img" element="img"
                            class-name="stamp bottom-left" bound-attr="src" set="append-once" class="input-field">
                    </div>
                    <div class="form-item demo-attribute">
                        <label
                            for="form-top-right-stamp-url">{{ __('product_meta.product_attr_top_right_stamp_url') }}</label>
                        <input name="{{ ModelMetaKey::TOP_RIGHT_STAMP_URL }}"
                            value="{{ old(ModelMetaKey::TOP_RIGHT_STAMP_URL) ?? (get_meta($productMeta, ModelMetaKey::TOP_RIGHT_STAMP_URL)->value ?? null) }}"
                            type="text" id="form-top-right-stamp-url" layout="holder-img" element="img"
                            class-name="stamp top-right" bound-attr="src" set="append-once" class="input-field">
                    </div>
                    <div class="form-item demo-attribute">
                        <label for="form-badge-icon">{{ __('product_meta.product_attr_badge_icon_url') }}</label>
                        <input name="product_attr_badge_icon_url"
                            value="{{ old('product_attr_badge_icon_url') ?? isset(get_meta($productMeta, ModelMetaKey::BADGE)->value)
                                ? unserialize(get_meta($productMeta, ModelMetaKey::BADGE)->value)['product_attr_badge_icon_url']
                                : null }}"
                            type="text" id="form-badge-icon" layout="layout-badge" element="img" class-name="badge"
                            bound-attr="src" set="append-once" class="input-field">
                    </div>
                    <div class="form-item demo-attribute">
                        <label for="form-badge-background">{{ __('product_meta.product_attr_badge_background') }}</label>
                        <input name="product_attr_badge_background"
                            value="{{ old('product_attr_badge_background') ?? isset(get_meta($productMeta, ModelMetaKey::BADGE)->value)
                                ? unserialize(get_meta($productMeta, ModelMetaKey::BADGE)->value)['product_attr_badge_background']
                                : null }}"
                            id="form-badge-layout" type="text" layout="layout-badge" bound-attr="class"
                            default-value="layout-badge" placeholder="bg1, bg2, bg3, bg4..." set="append-once"
                            class="input-field">
                    </div>
                    <div class="form-item demo-attribute">
                        <label for="form-title">{{ __('product_meta.product_attr_badge_text') }}</label>
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
                        <label for="form-compare-tags">{{ __('product_meta.product_attr_compare_tags') }}</label>
                        <textarea name="{{ ModelMetaKey::COMPARE_TAGS }}" id="form-compare-tags" cols="20" rows="2"
                            layout="layout-compare-tags" element="span" set="line-separated" class-name="compare-tag"
                            bound-attr="multiple-text/html" class="input-field">{{ $text }}</textarea>
                    </div>
                    <div class="form-item demo-attribute">
                        <label for="form-regular-price">{{ __('product_meta.product_attr_regular_price') }}</label>
                        <input name="{{ ModelMetaKey::REGULAR_PRICE }}"
                            value="{{ old(ModelMetaKey::REGULAR_PRICE) ?? isset(get_meta($productMeta, ModelMetaKey::REGULAR_PRICE)->value)
                                ? get_meta($productMeta, ModelMetaKey::REGULAR_PRICE)->value
                                : null }}"
                            type="text" id="form-regular-price" layout="layout-regular-price" element="span"
                            class-name="regular-price" bound-attr="text/html" class="input-field">
                    </div>
                    <div class="form-item demo-attribute">
                        <label for="form-price">{{ __('product_meta.product_attr_price') }}</label>
                        <input name="{{ ModelMetaKey::PRICE }}"
                            value="{{ old(ModelMetaKey::PRICE) ?? isset(get_meta($productMeta, ModelMetaKey::PRICE)->value)
                                ? get_meta($productMeta, ModelMetaKey::PRICE)->value
                                : null }}"
                            type="text" id="form-price" layout="layout-price" element="span" class-name="price"
                            bound-attr="text/html" class="input-field">
                    </div>
                    <div class="form-item demo-attribute">
                        <label for="form-gift">{{ __('product_meta.product_attr_gift') }}</label>
                        <input name="{{ ModelMetaKey::GIFT }}"
                            value="{{ old(ModelMetaKey::GIFT) ?? isset(get_meta($productMeta, ModelMetaKey::GIFT)->value)
                                ? get_meta($productMeta, ModelMetaKey::GIFT)->value
                                : null }}"
                            type="text" id="form-gift" layout="layout-gift" element="span" class-name="gift"
                            bound-attr="text/html" class="input-field">
                    </div>
                    <div class="layout-btn-demo">
                        <div class="item-btn" id="btn-demo-change">
                            {{ __('button.demo') }}
                            <span class="icon material-symbols-outlined">done_all</span>
                        </div>
                    </div>
                </div>

                <div class="section" for="layout-wysiwyg-product-description">
                    {{ __('product.description') }}
                    <span class="icon material-symbols-outlined">add</span>
                </div>
                <div class="section-content layout-wysiwyg-product-description" id="layout-wysiwyg-product-description">
                    <div id="wysiwyg-product-description">
                        {!! old('description') ?? $product->description !!}
                    </div>
                    <input type="hidden" name="description" value="{{ old('description') ?? $product->description }}">
                    <div class="layout-btn-demo">
                        <div class="item-btn" id="btn-demo-product-description">
                            {{ __('button.demo') }}
                            <span class="icon material-symbols-outlined">done_all</span>
                        </div>
                    </div>
                </div>

                <div class="section" for="layout-meta-data">
                    {{ __('product_meta.meta_data') }}
                    <span class="icon material-symbols-outlined">add</span>
                </div>
                <div class="section-content layout-meta-data" id="layout-meta-data">
                    <div class="form-item demo-attribute-to-table-product-meta">
                        <label for="form-meta-key">{{ __('product_meta.meta_key') }}</label>
                        <select id="form-meta-key">
                            @foreach (ModelMetaKey::notShownInCardCases() as $metaKey)
                                @if (str_starts_with($metaKey, 'product_attr_'))
                                    <option value="{{ $metaKey }}">{{ __("product_meta.$metaKey") }}</option>
                                @endif
                            @endforeach
                        </select>
                        <label for="form-meta-value">{{ __('product_meta.meta_value') }}</label>
                        <input type="text" id="form-meta-value">
                        <span class="icon material-symbols-outlined btn-add">add</span>
                    </div>
                    <table class="table-product-meta">
                        <thead>
                            <tr>
                                <th>{{ __('product_meta.meta_key') }}</th>
                                <th>{{ __('product_meta.meta_value') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (ModelMetaKey::notShownInCardCases() as $metaKey)
                                @if (old($metaKey) && in_array($meta->key, ModelMetaKey::notShownInCardCases()))
                                    <tr>
                                        <td class="meta-key">{{ __('product_meta.' . old($metaKey)) }}</td>
                                        <td class="meta-value">
                                            {{ old($metaKey) }}
                                            <span class="icon material-symbols-outlined btn-remove">close</span>
                                        </td>
                                        <input type="hidden" name="{{ $metaKey }}" value="{{ old($metaKey) }}">
                                    </tr>
                                @endif
                            @endforeach
                            @foreach ($productMeta as $meta)
                                @if (!old($metaKey) && in_array($meta->key, ModelMetaKey::notShownInCardCases()))
                                    <tr>
                                        <td class="meta-key">{{ __("product_meta.$meta->key") }}</td>
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
                    {{ __('term.term_taxonomy') }}
                    <span class="icon material-symbols-outlined">add</span>
                </div>
                <div class="section-content layout-term-taxonomy" id="layout-term-taxonomy">
                    <div class="form-item demo-attribute-to-table-product-term-taxonomy">
                        <label for="form-term-taxonomy">{{ __('term.term_taxonomy') }}</label>
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
                                <th>{{ __('term.term_taxonomy') }}</th>
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

                <div class="section" for="layout-variants">
                    {{ __('product.variants') }}
                    <span class="icon material-symbols-outlined">add</span>
                </div>
                <div class="section-content layout-variants" id="layout-variants">
                    <p>
                        Apply the following data from the editing product to these selected products (variants):
                    </p>
                    <div class="layout-applied-data-checkbox">
                        <p>Product fields</p>
                        <input type="hidden" name="variants_applied_data" id="variants_applied_data">
                        <div class="applied-data-field">
                            <input type="checkbox" id="variants_title" name="variants_title" value="title">
                            <label for="variants_title" class="applied-data-label">{{ __('product.title') }}</label>
                        </div>

                        <div class="applied-data-field">
                            <input type="checkbox" id="variants_type" name="variants_type" value="type">
                            <label for="variants_type" class="applied-data-label">{{ __('product.type') }}</label>
                        </div>

                        <div class="applied-data-field">
                            <input type="checkbox" id="variants_parent_id" name="variants_parent_id" value="parent_id">
                            <label for="variants_parent_id"
                                class="applied-data-label">{{ __('product.parent_product') }}</label>
                        </div>

                        <div class="applied-data-field">
                            <input type="checkbox" id="variants_status" name="variants_status" value="status">
                            <label for="variants_status"
                                class="applied-data-label">{{ __('product.status.status') }}</label>
                        </div>

                        <div class="applied-data-field">
                            <input type="checkbox" id="variants_description" name="variants_description"
                                value="description">
                            <label for="variants_description"
                                class="applied-data-label">{{ __('product.description') }}</label>
                        </div>

                        <p>Product Meta fields</p>
                        <div class="applied-data-field">
                            <input type="checkbox" id="variants_top_tags" name="variants_top_tags"
                                value="{{ ModelMetaKey::TOP_TAGS }}">
                            <label for="variants_top_tags"
                                class="applied-data-label">{{ __('product_meta.product_attr_top_tags') }}</label>
                        </div>

                        <div class="applied-data-field">
                            <input type="checkbox" id="variants_thumb_url" name="variants_thumb_url"
                                value="{{ ModelMetaKey::THUMB_URL }}">
                            <label for="variants_thumb_url"
                                class="applied-data-label">{{ __('product_meta.product_attr_thumb_url') }}</label>
                        </div>

                        <div class="applied-data-field">
                            <input type="checkbox" id="variants_bottom_left_stamp_url"
                                name="variants_bottom_left_stamp_url" value="{{ ModelMetaKey::BOTTOM_LEFT_STAMP_URL }}">
                            <label for="variants_bottom_left_stamp_url"
                                class="applied-data-label">{{ __('product_meta.product_attr_bottom_left_stamp_url') }}</label>
                        </div>

                        <div class="applied-data-field">
                            <input type="checkbox" id="variants_top_right_stamp_url" name="variants_top_right_stamp_url"
                                value="{{ ModelMetaKey::TOP_RIGHT_STAMP_URL }}">
                            <label for="variants_top_right_stamp_url"
                                class="applied-data-label">{{ __('product_meta.product_attr_top_right_stamp_url') }}</label>
                        </div>

                        <div class="applied-data-field">
                            <input type="checkbox" id="variants_badge" name="variants_badge"
                                value="{{ ModelMetaKey::BADGE }}">
                            <label for="variants_badge"
                                class="applied-data-label">{{ __('product_meta.product_attr_badge') }}</label>
                        </div>

                        <div class="applied-data-field">
                            <input type="checkbox" id="variants_compare_tags" name="variants_compare_tags"
                                value="{{ ModelMetaKey::COMPARE_TAGS }}">
                            <label for="variants_compare_tags"
                                class="applied-data-label">{{ __('product_meta.product_attr_compare_tags') }}</label>
                        </div>

                        <div class="applied-data-field">
                            <input type="checkbox" id="variants_regular_price" name="variants_regular_price"
                                value="{{ ModelMetaKey::REGULAR_PRICE }}">
                            <label for="variants_regular_price"
                                class="applied-data-label">{{ __('product_meta.product_attr_regular_price') }}</label>
                        </div>

                        <div class="applied-data-field">
                            <input type="checkbox" id="variants_price" name="variants_price"
                                value="{{ ModelMetaKey::PRICE }}">
                            <label for="variants_price"
                                class="applied-data-label">{{ __('product_meta.product_attr_price') }}</label>
                        </div>

                        <div class="applied-data-field">
                            <input type="checkbox" id="variants_gift" name="variants_gift"
                                value="{{ ModelMetaKey::GIFT }}">
                            <label for="variants_gift"
                                class="applied-data-label">{{ __('product_meta.product_attr_gift') }}</label>
                        </div>
                    </div>
                    <x-product.list.index>
                        @foreach ($variants as $variant)
                            <div class="outer-checkbox">
                                <div class="layout-checkbox">
                                    <input type="checkbox" name="{{ $variant->slug }}" value="true">
                                </div>
                                <x-product.card.index :product="$variant" :selected-variant-meta="$variant->productMetaInCardView ?? null" :url="route('admin.products.slug', $variant->slug ?? '')" />
                            </div>
                        @endforeach
                    </x-product.list.index>
                </div>

                <div class="section" for="layout-siblings">
                    {{ __('product.siblings') }}
                    <span class="icon material-symbols-outlined">add</span>
                </div>
                <div class="section-content layout-siblings" id="layout-siblings">
                    <p>
                        Apply the following data from the editing product to these selected products (variants):
                    </p>
                    <div class="layout-applied-data-checkbox">
                        <p>Product fields</p>
                        <input type="hidden" name="siblings_applied_data" id="siblings_applied_data">
                        <div class="applied-data-field">
                            <input type="checkbox" id="siblings_title" name="siblings_title" value="title">
                            <label for="siblings_title" class="applied-data-label">{{ __('product.title') }}</label>
                        </div>

                        <div class="applied-data-field">
                            <input type="checkbox" id="siblings_type" name="siblings_type" value="type">
                            <label for="siblings_type" class="applied-data-label">{{ __('product.type') }}</label>
                        </div>

                        <div class="applied-data-field">
                            <input type="checkbox" id="siblings_parent_id" name="siblings_parent_id" value="parent_id">
                            <label for="siblings_parent_id"
                                class="applied-data-label">{{ __('product.parent_product') }}</label>
                        </div>

                        <div class="applied-data-field">
                            <input type="checkbox" id="siblings_status" name="siblings_status" value="status">
                            <label for="siblings_status"
                                class="applied-data-label">{{ __('product.status.status') }}</label>
                        </div>

                        <div class="applied-data-field">
                            <input type="checkbox" id="siblings_description" name="siblings_description"
                                value="description">
                            <label for="siblings_description"
                                class="applied-data-label">{{ __('product.description') }}</label>
                        </div>

                        <p>Product Meta fields</p>
                        <div class="applied-data-field">
                            <input type="checkbox" id="siblings_top_tags" name="siblings_top_tags"
                                value="{{ ModelMetaKey::TOP_TAGS }}">
                            <label for="siblings_top_tags"
                                class="applied-data-label">{{ __('product_meta.product_attr_top_tags') }}</label>
                        </div>

                        <div class="applied-data-field">
                            <input type="checkbox" id="siblings_thumb_url" name="siblings_thumb_url"
                                value="{{ ModelMetaKey::THUMB_URL }}">
                            <label for="siblings_thumb_url"
                                class="applied-data-label">{{ __('product_meta.product_attr_thumb_url') }}</label>
                        </div>

                        <div class="applied-data-field">
                            <input type="checkbox" id="siblings_bottom_left_stamp_url"
                                name="siblings_bottom_left_stamp_url" value="{{ ModelMetaKey::BOTTOM_LEFT_STAMP_URL }}">
                            <label for="siblings_bottom_left_stamp_url"
                                class="applied-data-label">{{ __('product_meta.product_attr_bottom_left_stamp_url') }}</label>
                        </div>

                        <div class="applied-data-field">
                            <input type="checkbox" id="siblings_top_right_stamp_url" name="siblings_top_right_stamp_url"
                                value="{{ ModelMetaKey::TOP_RIGHT_STAMP_URL }}">
                            <label for="siblings_top_right_stamp_url"
                                class="applied-data-label">{{ __('product_meta.product_attr_top_right_stamp_url') }}</label>
                        </div>

                        <div class="applied-data-field">
                            <input type="checkbox" id="siblings_badge" name="siblings_badge"
                                value="{{ ModelMetaKey::BADGE }}">
                            <label for="siblings_badge"
                                class="applied-data-label">{{ __('product_meta.product_attr_badge') }}</label>
                        </div>

                        <div class="applied-data-field">
                            <input type="checkbox" id="siblings_compare_tags" name="siblings_compare_tags"
                                value="{{ ModelMetaKey::COMPARE_TAGS }}">
                            <label for="siblings_compare_tags"
                                class="applied-data-label">{{ __('product_meta.product_attr_compare_tags') }}</label>
                        </div>

                        <div class="applied-data-field">
                            <input type="checkbox" id="siblings_regular_price" name="siblings_regular_price"
                                value="{{ ModelMetaKey::REGULAR_PRICE }}">
                            <label for="siblings_regular_price"
                                class="applied-data-label">{{ __('product_meta.product_attr_regular_price') }}</label>
                        </div>

                        <div class="applied-data-field">
                            <input type="checkbox" id="siblings_price" name="siblings_price"
                                value="{{ ModelMetaKey::PRICE }}">
                            <label for="siblings_price"
                                class="applied-data-label">{{ __('product_meta.product_attr_price') }}</label>
                        </div>

                        <div class="applied-data-field">
                            <input type="checkbox" id="siblings_gift" name="siblings_gift"
                                value="{{ ModelMetaKey::GIFT }}">
                            <label for="siblings_gift"
                                class="applied-data-label">{{ __('product_meta.product_attr_gift') }}</label>
                        </div>
                    </div>
                    <x-product.list.index>
                        @foreach ($siblings as $sibling)
                            <div class="outer-checkbox">
                                <div class="layout-checkbox">
                                    <input type="checkbox" name="{{ $sibling->slug }}" value="true">
                                </div>
                                <x-product.card.index :product="$sibling" :selected-variant-meta="$sibling->productMetaInCardView ?? null" :url="route('admin.products.slug', $sibling->slug ?? '')" />
                            </div>
                        @endforeach
                    </x-product.list.index>
                </div>
            </form>
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
            {!! old('description') ?? $product->description !!}
        </div>
    </div>
    <div class="layer-shadow-overlay"></div>
    <input type="hidden" id="csrf-token" value="{{ csrf_token() }}" />
    <input type="hidden" id="product-id" value="{{ $product->id }}" />
@endsection

@section('scripts')
    @parent
    @vite($viewsDir . '/admin/products/create-edit-ui-interaction.js')
    @vite($viewsDir . '/admin/products/create-edit-server-interaction.js')
    @vite($viewsDir . '/admin/products/wysiwyg.js')

@endsection
