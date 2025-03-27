<!-- You must be the change you wish to see in the world. - Mahatma Gandhi -->
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
        <div class="applied-data-field">
            <input type="checkbox" id="siblings_title" name="reflect_product_fields_on_siblings[]" value="title">
            <label for="siblings_title" class="applied-data-label">{{ __('product.title') }}</label>
        </div>

        <div class="applied-data-field">
            <input type="checkbox" id="siblings_type" name="reflect_product_fields_on_siblings[]" value="type">
            <label for="siblings_type" class="applied-data-label">{{ __('product.type') }}</label>
        </div>

        <div class="applied-data-field">
            <input type="checkbox" id="siblings_parent_id" name="reflect_product_fields_on_siblings[]"
                   value="parent_id">
            <label for="siblings_parent_id" class="applied-data-label">{{ __('product.parent_product') }}</label>
        </div>

        <div class="applied-data-field">
            <input type="checkbox" id="siblings_status" name="reflect_product_fields_on_siblings[]" value="status">
            <label for="siblings_status" class="applied-data-label">{{ __('product.status.status') }}</label>
        </div>

        <div class="applied-data-field">
            <input type="checkbox" id="siblings_description" name="reflect_product_fields_on_siblings[]"
                   value="description">
            <label for="siblings_description" class="applied-data-label">{{ __('product.description') }}</label>
        </div>

        <p>Product Meta fields</p>
        <div class="applied-data-field">
            <input type="checkbox" id="siblings_top_tags" name="reflect_product_meta_fields_on_siblings[]"
                   value="{{ ModelMetaKey::TOP_TAGS }}">
            <label for="siblings_top_tags"
                   class="applied-data-label">{{ __('product_meta.product_attr_top_tags') }}</label>
        </div>

        <div class="applied-data-field">
            <input type="checkbox" id="siblings_thumb_url" name="reflect_product_meta_fields_on_siblings[]"
                   value="{{ ModelMetaKey::THUMB_URL }}">
            <label for="siblings_thumb_url"
                   class="applied-data-label">{{ __('product_meta.product_attr_thumb_url') }}</label>
        </div>

        <div class="applied-data-field">
            <input type="checkbox" id="siblings_bottom_left_stamp_url" name="reflect_product_meta_fields_on_siblings[]"
                   value="{{ ModelMetaKey::BOTTOM_LEFT_STAMP_URL }}">
            <label for="siblings_bottom_left_stamp_url"
                   class="applied-data-label">{{ __('product_meta.product_attr_bottom_left_stamp_url') }}</label>
        </div>

        <div class="applied-data-field">
            <input type="checkbox" id="siblings_top_right_stamp_url" name="reflect_product_meta_fields_on_siblings[]"
                   value="{{ ModelMetaKey::TOP_RIGHT_STAMP_URL }}">
            <label for="siblings_top_right_stamp_url"
                   class="applied-data-label">{{ __('product_meta.product_attr_top_right_stamp_url') }}</label>
        </div>

        <div class="applied-data-field">
            <input type="checkbox" id="siblings_badge" name="reflect_product_meta_fields_on_siblings[]"
                   value="{{ ModelMetaKey::BADGE }}">
            <label for="siblings_badge" class="applied-data-label">{{ __('product_meta.product_attr_badge') }}</label>
        </div>

        <div class="applied-data-field">
            <input type="checkbox" id="siblings_compare_tags" name="reflect_product_meta_fields_on_siblings[]"
                   value="{{ ModelMetaKey::COMPARE_TAGS }}">
            <label for="siblings_compare_tags"
                   class="applied-data-label">{{ __('product_meta.product_attr_compare_tags') }}</label>
        </div>

        <div class="applied-data-field">
            <input type="checkbox" id="siblings_regular_price" name="reflect_product_meta_fields_on_siblings[]"
                   value="{{ ModelMetaKey::LIST_PRICE }}">
            <label for="siblings_regular_price"
                   class="applied-data-label">{{ __('product_meta.product_attr_regular_price') }}</label>
        </div>

        <div class="applied-data-field">
            <input type="checkbox" id="siblings_price" name="reflect_product_meta_fields_on_siblings[]"
                   value="{{ ModelMetaKey::PRICE }}">
            <label for="siblings_price" class="applied-data-label">{{ __('product_meta.product_attr_price') }}</label>
        </div>

        <div class="applied-data-field">
            <input type="checkbox" id="siblings_gift" name="reflect_product_meta_fields_on_siblings[]"
                   value="{{ ModelMetaKey::GIFT }}">
            <label for="siblings_gift" class="applied-data-label">{{ __('product_meta.product_attr_gift') }}</label>
        </div>
    </div>

    <h3>{{ __('product.product') }}</h3>
    <div class="layout-btn-line">
        <div class="item-btn" id="btn-select-all-siblings">
            {{ __('button.select_all') }}
            <span class="icon material-symbols-outlined">check_box</span>
        </div>
        <div class="item-btn" id="btn-deselect-all-siblings">
            {{ __('button.deselect_all') }}
            <span class="icon material-symbols-outlined">check_box_outline_blank</span>
        </div>
    </div>

    <x-product.list.index id="layout-list-siblings">
        @foreach ($siblings as $sibling)
            <div class="outer-checkbox">
                <div class="layout-checkbox">
                    <input type="checkbox" name="siblings_slug[]" value="{{ $sibling->slug }}" class="checkbox-sibling">
                </div>
                <x-product.card.index
                    :product="$sibling"
                    :selected-variant-meta="$sibling->productMetaInCardView ?? null"
                    :url="route('admin.products.slug', $sibling->slug ?? '')"/>
            </div>
        @endforeach
    </x-product.list.index>
</div>
@pushonce('scripts')
    @vite($viewsDir . '/components/admin/products/section/siblings.js')
@endpushonce
