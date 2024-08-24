@pushOnce('styles')
    @vite($viewsDir . '/components/partial/filter/product/panel/index.css')
@endPushOnce
<span class="material-symbols-outlined pointer-arrow">change_history</span>
<div class="layout-panel-dropdown {{ $align ?? 'left' }}">
    <x-dynamic-component :component="$componentPanel" />
</div>
