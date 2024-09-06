@push('styles')
    @vite($viewsDir . '/components/partial/filter/product/partial-filter.css')
@endPush

<!-- Simplicity is an acquired taste. - Katharine Gerould -->
<div class="layout-filter">
    <div class="filters-row">
        <x-partial.filter.product.btn-dropdown :icon-before="'filter_alt'" :name="'Bộ lọc'" :icon-dropdown="false" />
        <x-partial.filter.product.btn-dropdown :name="'Hãng'" :icon-dropdown="true" :component-panel="'partial.filter.product.panel.brand'" />
        <x-partial.filter.product.btn-dropdown :name="'Giá'" :icon-dropdown="true" :component-panel="'partial.filter.product.panel.price'" />
        <x-partial.filter.product.btn-dropdown :name="'Loại điện thoại'" :icon-dropdown="true" :component-panel="'partial.filter.product.panel.os'" />
        <x-partial.filter.product.btn-dropdown :name="'Nhu cầu'" :icon-dropdown="true" />
        <x-partial.filter.product.btn-dropdown :name="'RAM'" :icon-dropdown="true" :component-panel="'partial.filter.product.panel.ram'" />
        <x-partial.filter.product.btn-dropdown :name="'Màn hình'" :icon-dropdown="true" />
        <x-partial.filter.product.btn-dropdown :name="'Dung lượng lưu trữ'" :icon-dropdown="true" :component-panel="'partial.filter.product.panel.rom'" :align="'right'"/>
        <x-partial.filter.product.btn-dropdown :name="'Tính năng sạc'" :icon-dropdown="true" :align="'right'"/>
        <x-partial.filter.product.btn-dropdown :name="'Tính năng đặc biệt'" :icon-dropdown="true" :align="'right'"/>
    </div>
</div>
