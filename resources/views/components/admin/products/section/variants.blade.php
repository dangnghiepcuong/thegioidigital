<!-- Always remember that you are absolutely unique. Just like everyone else. - Margaret Mead -->
@use('App\Enums\ModelMetaKey')

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
            <label for="variants_parent_id" class="applied-data-label">{{ __('product.parent_product') }}</label>
        </div>

        <div class="applied-data-field">
            <input type="checkbox" id="variants_status" name="variants_status" value="status">
            <label for="variants_status" class="applied-data-label">{{ __('product.status.status') }}</label>
        </div>

        <div class="applied-data-field">
            <input type="checkbox" id="variants_description" name="variants_description" value="description">
            <label for="variants_description" class="applied-data-label">{{ __('product.description') }}</label>
        </div>

        <p>Product Meta fields</p>
        <div class="applied-data-field">
            <input type="checkbox" id="variants_top_tags" name="variants_top_tags" value="{{ ModelMetaKey::TOP_TAGS }}">
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
            <input type="checkbox" id="variants_bottom_left_stamp_url" name="variants_bottom_left_stamp_url"
                   value="{{ ModelMetaKey::BOTTOM_LEFT_STAMP_URL }}">
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
            <input type="checkbox" id="variants_badge" name="variants_badge" value="{{ ModelMetaKey::BADGE }}">
            <label for="variants_badge" class="applied-data-label">{{ __('product_meta.product_attr_badge') }}</label>
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
            <input type="checkbox" id="variants_price" name="variants_price" value="{{ ModelMetaKey::PRICE }}">
            <label for="variants_price" class="applied-data-label">{{ __('product_meta.product_attr_price') }}</label>
        </div>

        <div class="applied-data-field">
            <input type="checkbox" id="variants_gift" name="variants_gift" value="{{ ModelMetaKey::GIFT }}">
            <label for="variants_gift" class="applied-data-label">{{ __('product_meta.product_attr_gift') }}</label>
        </div>
    </div>

    <h3>{{ __('product.product') }}</h3>
    <div class="layout-btn-line">
        <div class="item-btn" id="btn-select-all-variants">
            {{ __('button.select_all') }}
            <span class="icon material-symbols-outlined">check_box</span>
        </div>
        <div class="item-btn" id="btn-deselect-all-variants">
            {{ __('button.deselect_all') }}
            <span class="icon material-symbols-outlined">check_box_outline_blank</span>
        </div>
    </div>

    <x-product.list.index id="layout-list-variants">
        @foreach ($variants as $variant)
            <div class="outer-checkbox">
                <div class="layout-checkbox">
                    <input type="checkbox" name="{{ $variant->slug }}" value="true" class="checkbox-variant">
                </div>
                <x-product.card.index
                    :product="$variant"
                    :selected-variant-meta="$variant->productMetaInCardView ?? null"
                    :url="route('admin.products.slug', $variant->slug ?? '')"/>
            </div>
        @endforeach
    </x-product.list.index>
</div>
