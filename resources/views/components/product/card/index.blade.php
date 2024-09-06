@pushOnce('styles')
    @vite($viewsDir . '/components/product/card/index.css')
@endPushOnce
@use('App\Enums\ModelMetaKey')
<!-- The whole future lies in uncertainty: live immediately. - Seneca -->
<div class="card-product">
    <a href="{{ $url ?? null }}">
        <div class="layout-top-tags">
            @isset(get_meta($productMeta, ModelMetaKey::TOP_TAGS)->value)
                @foreach (unserialize(get_meta($productMeta, ModelMetaKey::TOP_TAGS)->value) as $topTag)
                    <span class="top-tag">{{ $topTag }}</span>
                @endforeach
            @endisset
        </div>

        @isset(get_meta($productMeta, ModelMetaKey::THUMB_URL)->value)
            <div class="holder-img">
                <img class="thumb ls-is-cached lazyloaded"
                    data-src="{{ get_meta($productMeta, ModelMetaKey::THUMB_URL)->value }}"
                    alt="{{ $product->title ?? null }}" src="{{ get_meta($productMeta, ModelMetaKey::THUMB_URL)->value }}">
                @isset(get_meta($productMeta, ModelMetaKey::BOTTOM_LEFT_STAMP_URL)->value)
                    <img data-src="{{ get_meta($productMeta, ModelMetaKey::BOTTOM_LEFT_STAMP_URL)->value }}"
                        class="stamp bottom-left"
                        src="{{ get_meta($productMeta, ModelMetaKey::BOTTOM_LEFT_STAMP_URL)->value }}">
                @endisset
            </div>
        @endisset

        @isset(get_meta($productMeta, ModelMetaKey::BADGE)->value)
            <div
                class="layout-badge {{ unserialize(get_meta($productMeta, ModelMetaKey::BADGE)->value)['product_attr_badge_background'] }}">
                <img class="badge"
                    alt="{{ unserialize(get_meta($productMeta, ModelMetaKey::BADGE)->value)['product_attr_badge_text'] }}"
                    src="{{ unserialize(get_meta($productMeta, ModelMetaKey::BADGE)->value)['product_attr_badge_icon_url'] }}">
                <span
                    class="badge-text">{{ unserialize(get_meta($productMeta, ModelMetaKey::BADGE)->value)['product_attr_badge_text'] }}</span>
            </div>
        @endisset

        <div class="holder-product-name">
            @isset($product->title)
                <span class="product-name">{{ $product->title }}</span>
            @endisset
        </div>

        @isset(get_meta($productMeta, ModelMetaKey::COMPARE_TAGS)->value)
            <div class="layout-compare-tags">
                @foreach (unserialize(get_meta($productMeta, ModelMetaKey::COMPARE_TAGS)->value) as $compareTag)
                    <span class="compare-tag">{{ $compareTag }}</span>
                @endforeach
            </div>
        @endisset

        @empty($product->parent_id)
            @if (isset($firstOption) && isset($product->termTaxonomies))
                <div class="layout-attribute-options">
                    @foreach ($product->termTaxonomies->where('taxonomy', $firstOption->taxonomy) as $termTaxonomy)
                        @if ($termTaxonomy->taxonomy === $firstOption->taxonomy)
                            <span class="btn btn-selection attribute-option {{ $loop->first ? 'selected-option' : null }}">
                                {{ $termTaxonomy->term->name }}
                            </span>
                        @endif
                    @endforeach
                </div>
            @endif
        @endempty

        @isset(get_meta($productMeta, ModelMetaKey::REGULAR_PRICE)->value)
            <div class="layout-regular-price">
                <span class="regular-price">{{ get_meta($productMeta, ModelMetaKey::REGULAR_PRICE)->getCurrency() }}</span>
                @isset(get_meta($productMeta, ModelMetaKey::PRICE)->value)
                    <span
                        class="discount">{{ '-' .
                            floor(
                                ((get_meta($productMeta, ModelMetaKey::REGULAR_PRICE)->value -
                                    get_meta($productMeta, ModelMetaKey::PRICE)->value) /
                                    get_meta($productMeta, ModelMetaKey::REGULAR_PRICE)->value) *
                                    100,
                            ) .
                            '%' }}
                    </span>
                @endisset
            </div>
        @endisset

        @isset(get_meta($productMeta, ModelMetaKey::PRICE)->value)
            <div class="layout-price">
                <span class="price">{{ get_meta($productMeta, ModelMetaKey::PRICE)->getCurrency() }}</span>
            </div>
        @endisset

        @isset(get_meta($productMeta, ModelMetaKey::GIFT)->value)
            <div class="layout-gift">
                Quà <span class="gift">{{ get_meta($productMeta, ModelMetaKey::GIFT)->getCurrency() }}</span>
            </div>
        @endisset

        @isset(get_meta($productMeta, 'RATE')->value)
            <div class="layout-rate">
                <span class="icon starred material-symbols-outlined">star</span>
                <span class="icon starred material-symbols-outlined">star</span>
                <span class="icon starred material-symbols-outlined">star</span>
                <span class="icon material-symbols-outlined">star</span>
                <span class="icon material-symbols-outlined">star</span>
                <span class="rate">178</span>
            </div>
        @endisset
    </a>
</div>
