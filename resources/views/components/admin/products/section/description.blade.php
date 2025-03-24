<!-- You must be the change you wish to see in the world. - Mahatma Gandhi -->
@use('App\Enums\ModelMetaKey')

<div class="section" for="layout-wysiwyg-product-description">
    {{ __('product.description') }}
    <span class="icon material-symbols-outlined">add</span>
</div>
<div class="section-content layout-wysiwyg-product-description" id="layout-wysiwyg-product-description">
    <div id="wysiwyg-product-description">
        {!! old('description') ?? $product->description ?? null !!}
    </div>
    <input type="hidden" name="description" value="{{ old('description') ?? $product->description ?? null }}">
    <div class="layout-btn-line">
        <div class="item-btn" id="btn-demo-product-description">
            {{ __('button.demo') }}
            <span class="icon material-symbols-outlined">done_all</span>
        </div>
    </div>
</div>
@pushonce('scripts')
    @vite($viewsDir . '/components/admin/products/section/wysiwyg.js')
@endpushonce
