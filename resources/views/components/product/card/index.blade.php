@use('App\Enums\ModelMetaKey')
<div class="card-product">
    <!-- The whole future lies in uncertainty: live immediately. - Seneca -->
    <a href="{{ $url ?? null }}" onclick="return false">
        <div class="layout-top-tags">
            @isset(get_meta($selectedVariantMeta, ModelMetaKey::TOP_TAGS)->value)
                @foreach (unserialize(get_meta($selectedVariantMeta, ModelMetaKey::TOP_TAGS)->value) as $topTag)
                    <span class="top-tag">{{ $topTag }}</span>
                @endforeach
            @endisset
        </div>

        @isset(get_meta($selectedVariantMeta, ModelMetaKey::THUMB_URL)->value)
            <div class="holder-img">
                <img class="thumb" alt="{{ $product->title ?? null }}"
                    src="{{ get_meta($selectedVariantMeta, ModelMetaKey::THUMB_URL)->value }}">
                @isset(get_meta($selectedVariantMeta, ModelMetaKey::BOTTOM_LEFT_STAMP_URL)->value)
                    <img class="stamp bottom-left"
                        src="{{ get_meta($selectedVariantMeta, ModelMetaKey::BOTTOM_LEFT_STAMP_URL)->value }}">
                @endisset
            </div>
        @endisset

        @isset(get_meta($selectedVariantMeta, ModelMetaKey::BADGE)->value)
            <div
                class="layout-badge {{ unserialize(get_meta($selectedVariantMeta, ModelMetaKey::BADGE)->value)['product_attr_badge_background'] }}">
                <img class="badge"
                    alt="{{ unserialize(get_meta($selectedVariantMeta, ModelMetaKey::BADGE)->value)['product_attr_badge_text'] }}"
                    src="{{ unserialize(get_meta($selectedVariantMeta, ModelMetaKey::BADGE)->value)['product_attr_badge_icon_url'] }}">
                <span
                    class="badge-text">{{ unserialize(get_meta($selectedVariantMeta, ModelMetaKey::BADGE)->value)['product_attr_badge_text'] }}</span>
            </div>
        @endisset

        <div class="holder-product-name">
            @isset($product->title)
                <span class="product-name">{{ $product->title }}</span>
            @endisset
        </div>

        @isset(get_meta($selectedVariantMeta, ModelMetaKey::COMPARE_TAGS)->value)
            <div class="layout-compare-tags">
                @foreach (unserialize(get_meta($selectedVariantMeta, ModelMetaKey::COMPARE_TAGS)->value) as $compareTag)
                    <span class="compare-tag">{{ $compareTag }}</span>
                @endforeach
            </div>
        @endisset

        {!! $slot ?? null !!}

        @isset(get_meta($selectedVariantMeta, ModelMetaKey::PRICE)->value)
            <div class="layout-price">
                <span class="price">{{ get_meta($selectedVariantMeta, ModelMetaKey::PRICE)->getCurrency() }}</span>
            </div>
        @endisset

        @isset(get_meta($selectedVariantMeta, ModelMetaKey::REGULAR_PRICE)->value)
            <div class="layout-regular-price">
                <span
                    class="regular-price">{{ get_meta($selectedVariantMeta, ModelMetaKey::REGULAR_PRICE)->getCurrency() }}</span>
                @isset(get_meta($selectedVariantMeta, ModelMetaKey::PRICE)->value)
                    <span
                        class="discount">{{ '-' .
                            floor(
                                ((get_meta($selectedVariantMeta, ModelMetaKey::REGULAR_PRICE)->value -
                                    get_meta($selectedVariantMeta, ModelMetaKey::PRICE)->value) /
                                    get_meta($selectedVariantMeta, ModelMetaKey::REGULAR_PRICE)->value) *
                                    100,
                            ) .
                            '%' }}
                    </span>
                @endisset
            </div>
        @endisset

        @isset(get_meta($selectedVariantMeta, ModelMetaKey::GIFT)->value)
            <div class="layout-gift">
                Quà <span class="gift">{{ get_meta($selectedVariantMeta, ModelMetaKey::GIFT)->getCurrency() }}</span>
            </div>
        @endisset

        @isset(get_meta($selectedVariantMeta, 'RATE')->value)
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
