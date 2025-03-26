<div class="popup-demo-description layout-popup">
    <a class="btn-close" onclick="popupPanel('close')">
        <span class="icon material-symbols-outlined">close</span>
        <span>Đóng</span>
    </a>
    <div class="outer-scroll">
        <div id="layout-demo-product-description" class="layout-demo-product-description ck-content">
            {!! old('description') ?? $product->description ?? null !!}
        </div>
    </div>
</div>
<div class="layer-shadow-overlay"></div>
