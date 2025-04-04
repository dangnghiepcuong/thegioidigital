<!-- Knowing is not enough; we must apply. Being willing is not enough; we must do. - Leonardo da Vinci -->
@use('App\Enums\ModelMetaKey')

<div class="section" for="layout-basic-info">
    {{ __('product.basic_information') }}
    <span class="icon material-symbols-outlined">add</span>
</div>
<div class="section-content layout-basic-info" id="layout-basic-info">
    <div class="form-item demo-attribute">
        <label for="form-top-tags">{{ __('product_meta.product_attr_top_tags') }}</label>
        <textarea name="{{ ModelMetaKey::TOP_TAGS }}" id="form-top-tags" cols="20" rows="2" layout="layout-top-tags"
                  element="span" class-name="top-tag" bound-attr="multiple-text/html" set="line-separated"
                  class="input-field"
        >{{ old(ModelMetaKey::TOP_TAGS) ?? $topTags }}</textarea>
    </div>
    <div class="form-item demo-attribute">
        <label for="form-thumb-url">{{ __('product_meta.product_attr_thumb_url') }}</label>
        <input name="{{ ModelMetaKey::THUMB_URL }}"
               value="{{ old(ModelMetaKey::THUMB_URL) ?? $thumbUrl }}"
               type="text" id="form-thumb-url" layout="holder-img" element="img" class-name="thumb" bound-attr="src"
               set="append-once" class="input-field">
    </div>
    <div class="form-item demo-attribute">
        <label for="form-bottom-left-stamp-url">{{ __('product_meta.product_attr_bottom_left_stamp_url') }}</label>
        <input name="{{ ModelMetaKey::BOTTOM_LEFT_STAMP_URL }}"
               value="{{ old(ModelMetaKey::BOTTOM_LEFT_STAMP_URL) ?? $bottomLeftStampUrl }}"
               type="text" id="form-bottom-left-stamp-url" layout="holder-img" element="img"
               class-name="stamp bottom-left" bound-attr="src" set="append-once" class="input-field">
    </div>
    <div class="form-item demo-attribute">
        <label for="form-top-right-stamp-url">{{ __('product_meta.product_attr_top_right_stamp_url') }}</label>
        <input name="{{ ModelMetaKey::TOP_RIGHT_STAMP_URL }}"
               value="{{ old(ModelMetaKey::TOP_RIGHT_STAMP_URL) ?? $topRightStampUrl }}"
               type="text" id="form-top-right-stamp-url" layout="holder-img" element="img" class-name="stamp top-right"
               bound-attr="src" set="append-once" class="input-field">
    </div>
    <x-admin.products.section.badge-template
        :background-style="$badgeBgStyle ?? null"
        :background-color-1="$badgeBgColor1 ?? null"
        :background-color-2="$badgeBgColor2 ?? null"
        :background-url="$badgeBgUrl ?? null"
        :icon-url="$badgeIconUrl ?? null"
        :text-color="$badgeTextColor ?? null"
        :text="$badgeText ?? null"
    />
    <div class="form-item demo-attribute">
        <label for="form-compare-tags">{{ __('product_meta.product_attr_compare_tags') }}</label>
        <textarea name="{{ ModelMetaKey::COMPARE_TAGS }}" id="form-compare-tags" cols="20" rows="2"
                  layout="layout-compare-tags" element="span" set="line-separated" class-name="compare-tag"
                  bound-attr="multiple-text/html" class="input-field"
        >{{ old(ModelMetaKey::COMPARE_TAGS) ?? $compareTags }}</textarea>
    </div>
    <div class="form-item demo-attribute">
        <label for="form-regular-price">{{ __('product_meta.product_attr_regular_price') }}</label>
        <input name="{{ ModelMetaKey::REGULAR_PRICE }}"
               value="{{ old(ModelMetaKey::REGULAR_PRICE) ?? $regularPrice }}"
               type="text" id="form-regular-price" layout="layout-regular-price" element="span"
               class-name="regular-price" bound-attr="text/html" class="input-field">
    </div>
    <div class="form-item demo-attribute">
        <label for="form-price">{{ __('product_meta.product_attr_price') }}</label>
        <input name="{{ ModelMetaKey::PRICE }}"
               value="{{ old(ModelMetaKey::PRICE) ?? $price }}"
               type="text" id="form-price" layout="layout-price" element="span" class-name="price"
               bound-attr="text/html" class="input-field">
    </div>
    <div class="form-item demo-attribute">
        <label for="form-gift">{{ __('product_meta.product_attr_gift') }}</label>
        <input name="{{ ModelMetaKey::GIFT }}"
               value="{{ old(ModelMetaKey::GIFT) ?? $gift }}"
               type="text" id="form-gift" layout="layout-gift" element="span" class-name="gift"
               bound-attr="text/html" class="input-field">
    </div>
    <div class="layout-btn-line">
        <div class="item-btn btn-demo-change">
            {{ __('button.demo') }}
            <span class="icon material-symbols-outlined">done_all</span>
        </div>
    </div>
</div>
