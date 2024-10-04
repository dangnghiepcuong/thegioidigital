@use('App\Enums\ModelMetaKey')

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
