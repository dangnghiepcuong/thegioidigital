<div class="filter" onclick="showDropDownPanelFilter(this)">
    @if (isset($iconBefore))
        <span class="icon material-symbols-outlined">{{ $iconBefore }}</span>
    @endif
    <span @class(['title', 'icon-dropdown' => $iconDropdown ?? false])>
        {{ $name ?? null }}
    </span>

    @if (isset($componentPanel))
        <x-partial.filter.product.panel :component-panel="$componentPanel" :align="$align ?? null"/>
    @endif
</div>
@pushOnce('scripts')
    @vite($viewsDir . '/components/partial/filter/product/index.js')
@endPushOnce
