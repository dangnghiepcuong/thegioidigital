@use('App\Enums\ModelMetaKey')

<div class="section" for="layout-basic-info">
    {{ __('product.basic_information') }}
    <span class="icon material-symbols-outlined">add</span>
</div>
<div class="section-content layout-basic-info" id="layout-basic-info">
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
        <label for="form-top-tags">{{ __('product_meta.product_attr_top_tags') }}</label>
        <textarea name="{{ ModelMetaKey::TOP_TAGS }}" id="form-top-tags" cols="20" rows="2" layout="layout-top-tags"
            element="span" class-name="top-tag" bound-attr="multiple-text/html" set="line-separated" class="input-field">{{ $text ?? null }}</textarea>
    </div>
    <div class="form-item demo-attribute">
        <label for="form-thumb-url">{{ __('product_meta.product_attr_thumb_url') }}</label>
        <input name="{{ ModelMetaKey::THUMB_URL }}"
            value="{{ old(ModelMetaKey::THUMB_URL) ?? (get_meta($productMeta, ModelMetaKey::THUMB_URL)->value ?? null) }}"
            type="text" id="form-thumb-url" layout="holder-img" element="img" class-name="thumb" bound-attr="src"
            set="append-once" class="input-field">
    </div>
    <div class="form-item demo-attribute">
        <label for="form-bottom-left-stamp-url">{{ __('product_meta.product_attr_bottom_left_stamp_url') }}</label>
        <input name="{{ ModelMetaKey::BOTTOM_LEFT_STAMP_URL }}"
            value="{{ old(ModelMetaKey::BOTTOM_LEFT_STAMP_URL) ?? (get_meta($productMeta, ModelMetaKey::BOTTOM_LEFT_STAMP_URL)->value ?? null) }}"
            type="text" id="form-bottom-left-stamp-url" layout="holder-img" element="img"
            class-name="stamp bottom-left" bound-attr="src" set="append-once" class="input-field">
    </div>
    <div class="form-item demo-attribute">
        <label for="form-top-right-stamp-url">{{ __('product_meta.product_attr_top_right_stamp_url') }}</label>
        <input name="{{ ModelMetaKey::TOP_RIGHT_STAMP_URL }}"
            value="{{ old(ModelMetaKey::TOP_RIGHT_STAMP_URL) ?? (get_meta($productMeta, ModelMetaKey::TOP_RIGHT_STAMP_URL)->value ?? null) }}"
            type="text" id="form-top-right-stamp-url" layout="holder-img" element="img" class-name="stamp top-right"
            bound-attr="src" set="append-once" class="input-field">
    </div>
    <div class="form-item demo-attribute">
        <label for="form-badge-icon">{{ __('product_meta.product_attr_badge_icon_url') }}</label>
        <input name="product_attr_badge_icon_url"
            value="{{ old('product_attr_badge_icon_url') ?? isset(get_meta($productMeta, ModelMetaKey::BADGE)->value)
                ? unserialize(get_meta($productMeta, ModelMetaKey::BADGE)->value)['product_attr_badge_icon_url']
                : null }}"
            type="text" id="form-badge-icon" layout="layout-badge" element="img" class-name="badge" bound-attr="src"
            set="append-once" class="input-field">
    </div>
    <div class="form-item demo-attribute">
        <label for="form-badge-background">{{ __('product_meta.product_attr_badge_background') }}</label>
        <input name="product_attr_badge_background"
            value="{{ old('product_attr_badge_background') ?? isset(get_meta($productMeta, ModelMetaKey::BADGE)->value)
                ? unserialize(get_meta($productMeta, ModelMetaKey::BADGE)->value)['product_attr_badge_background']
                : null }}"
            id="form-badge-layout" type="text" layout="layout-badge" bound-attr="class" default-value="layout-badge"
            placeholder="bg1, bg2, bg3, bg4..." set="append-once" class="input-field">
    </div>
    <div class="form-item demo-attribute">
        <label for="form-title">{{ __('product_meta.product_attr_badge_text') }}</label>
        <input name="product_attr_badge_text"
            value="{{ old('product_attr_badge_text') ?? isset(get_meta($productMeta, ModelMetaKey::BADGE)->value)
                ? unserialize(get_meta($productMeta, ModelMetaKey::BADGE)->value)['product_attr_badge_text']
                : null }}"
            type="text" id="form-badge-text" layout="layout-badge" element="span" class-name="badge-text"
            bound-attr="text/html" set="append-once" class="input-field">
    </div>
    <div class="form-item demo-attribute">
        @php
            $text = '';
            if (isset(get_meta($productMeta, ModelMetaKey::COMPARE_TAGS)->value)) {
                foreach (unserialize(get_meta($productMeta, ModelMetaKey::COMPARE_TAGS)->value) as $compareTag) {
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
