@pushOnce('styles')
    @vite($viewsDir . '/components/product/list/index.css')
@endPushOnce
<!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
<div class="box-list-product">
    {{-- <div class="loader">
    </div> --}}
    <div class="layout-list-product">
        {{ $slot }}
    </div>
</div>
