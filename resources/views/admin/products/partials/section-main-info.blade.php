<div class="form-item demo-attribute">
    <label for="form-title">{{ __('product.title') }}</label>
    <input name="title" value="{{ old('title') ?? ($product->title ?? null) }}" class="input-field" type="text"
        id="form-title" layout="holder-product-name" element="span" class-name="product-name" bound-attr="text/html">
</div>
<div class="form-item">
    <label for="form-slug">{{ __('product.slug') }}</label>
    <input name="slug" value="{{ old('slug') ?? ($product->slug ?? null) }}" type="text" id="form-slug"
        class="input-field">
</div>
<div class="form-item">
    <label for="form-type">{{ __('product.type') }}</label>
    <div class="select-multiple input-field">
        @if (get_property($product, 'type') && !old('type'))
            <div class="select-item">
                <input name="type" type="radio" value="{{ get_property($product, 'type') ?? null }}" id="{{ get_property($product, 'type') }}"
                    checked>
                <label class="label-radio" for="{{ get_property($product, 'type') }}">{{ __("product.$product->type") }}</label>
            </div>
        @endif
        @if (old('type'))
            <div class="select-item">
                <input name="type" type="radio" value="{{ old('type') }}" id="{{ old('type') }}" checked>
                <label class="label-radio" for="{{ old('type') }}">{{ __('product.' . old('type')) }}</label>
            </div>
        @endif
        @foreach ($productTypesEnum as $productType)
            @if ($productType !== get_property($product, 'type') && $productType !== old('type'))
                <div class="select-item">
                    <input name="type" type="radio" value="{{ $productType }}" id="{{ $productType }}">
                    <label class="label-radio" for="{{ $productType }}">{{ __("product.$productType") }}</label>
                </div>
            @endif
        @endforeach
    </div>
</div>
<div class="form-item">
    <label for="form-parent-id">{{ __('product.parent_product') }}</label>
    <select name="parent_id" class-name="parent-id" id="parent_id"
        value="{{ old('parent_id') ?? get_property($product, 'parent_id') }}" class="input-field">
        <option value=""></option>
    </select>
</div>
<div class="form-item">
    <label for="form-status">{{ __('product.status.status') }}</label>
    <div class="select-multiple input-field" id="form-status">
        @if (get_property($product, 'status') && !old('status'))
            <div class="select-item">
                <input name="status" type="radio" value="{{ get_property($product, 'status') }}" id="{{ get_property($product, 'status') }}"
                    checked>
                <label class="label-radio"
                    for="{{ get_property($product, 'status') }}">{{ __("product.status.$product->status") }}</label>
            </div>
        @endif
        @if (old('status'))
            <div class="select-item">
                <input name="status" type="radio" value="{{ old('status') }}" id="{{ old('status') }}" checked>
                <label class="label-radio"
                    for="{{ old('status') }}">{{ __('product.status.' . old('status')) }}</label>
            </div>
        @endif
        @foreach ($productStatusesEnum as $productStatus)
            @if ($productStatus !== get_property($product, 'status') && $productStatus !== old('status'))
                <div class="select-item">
                    <input name="status" type="radio" value="{{ $productStatus }}" id="{{ $productStatus }}">
                    <label class="label-radio"
                        for="{{ $productStatus }}">{{ __("product.status.$productStatus") }}</label>
                </div>
            @endif
        @endforeach
    </div>
</div>
<div class="layout-btn-line">
    <div class="item-btn btn-demo-change">
        {{ __('button.demo') }}
        <span class="icon material-symbols-outlined">done_all</span>
    </div>
</div>
