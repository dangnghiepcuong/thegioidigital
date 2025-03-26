<!-- The best way to take care of the future is to take care of the present moment. - Thich Nhat Hanh -->
<div class="form-item demo-attribute">
    <label for="form-title">{{ __('product.title') }}</label>
    <input name="title" value="{{ old('title') ?? ($title ?? null) }}" class="input-field" type="text"
           id="form-title" layout="holder-product-name" element="span" class-name="product-name" bound-attr="text/html">
</div>
<div class="form-item">
    <label for="form-slug">{{ __('product.slug') }}</label>
    <input name="slug" value="{{ old('slug') ?? ($slug ?? null) }}" type="text" id="form-slug"
           class="input-field">
</div>
<div class="form-item">
    <label for="form-type">{{ __('product.type') }}</label>
    <div class="select-multiple input-field">
        @if ($type && !old('type'))
            <div class="select-item">
                <input name="type" type="radio" value="{{ $type ?? null }}"
                       id="{{ $type }}"
                       checked>
                <label class="label-radio"
                       for="{{ $type }}">{{ __("product.$type") }}</label>
            </div>
        @endif
        @if (old('type'))
            <div class="select-item">
                <input name="type" type="radio" value="{{ old('type') }}" id="{{ old('type') }}" checked>
                <label class="label-radio" for="{{ old('type') }}">{{ __('product.' . old('type')) }}</label>
            </div>
        @endif
        @foreach ($productTypesEnum as $productType)
            @if ($productType !== $type && $productType !== old('type'))
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
            value="{{ old('parent_id') ?? $parentId }}" class="input-field">
        @isset($parentProducts)
            @if(old('parent_id'))
                <option value="{{ old('parent_id') }}">{{ Arr::get($parentProducts->find(old('parent_id')), 'title') }}</option>
                <option value=""></option>
                @foreach ($parentProducts->where('id', '!=', old('parent_id')) as $parentProduct)
                    <option value="{{ $parentProduct->id }}">{{ Arr::get($parentProduct, 'title') }}</option>
                @endforeach
            @elseif($parentId)
                <option value="{{ $parentId }}">{{ Arr::get($parentProducts->where('id', $parentId)->first(), 'title') }}</option>
                <option value=""></option>
                @foreach ($parentProducts->where('id', '!=', $parentId) as $parentProduct)
                    <option value="{{ Arr::get($parentProduct, 'id') }}">{{ Arr::get($parentProduct, 'title') }}</option>
                @endforeach
            @else
                <option value=""></option>
                @foreach ($parentProducts as $parentProduct)
                    <option value="{{ Arr::get($parentProduct, 'id') }}">{{ Arr::get($parentProduct, 'title') }}</option>
                @endforeach
            @endif
        @endisset
    </select>
</div>
<div class="form-item">
    <label for="form-status">{{ __('product.status.status') }}</label>
    <div class="select-multiple input-field" id="form-status">
        @if ($status && !old('status'))
            <div class="select-item">
                <input name="status" type="radio" value="{{ $status }}"
                       id="{{ $status }}"
                       checked>
                <label class="label-radio"
                       for="{{ $status }}">{{ __("product.status.$status") }}</label>
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
            @if ($productStatus !== $status && $productStatus !== old('status'))
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
