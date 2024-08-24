@extends('layouts.product.index')
@section('title', 'Điện thoại smartphone')

@section('styles')
    @parent
    @vite($viewsDir . '/product/dtdd.css')
@endsection

@section('content')
    @parent
    <!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
    <div class="most-filters-row">
        <span class="most-filter-label">Tìm kiếm nhiều: </span>
        <x-partial.filter.product.label-brand :brand-logo-link="'https://cdnv2.tgdd.vn/mwg-static/common/Category/92/e5/92e5003382a0bada9a770618b6c6099b.png'" />
        <x-partial.filter.product.label-brand :brand-logo-link="'https://cdnv2.tgdd.vn/mwg-static/common/Category/31/ce/31ce9dafafac121361ee7cbd313ae76b.png'" />
        <x-partial.filter.product.label-brand :brand-logo-link="'https://cdnv2.tgdd.vn/mwg-static/common/Category/e6/02/e602583e5e16acedfe54ab41b08b5d4f.png'" />
        <x-partial.filter.product.label-brand :brand-logo-link="'https://cdnv2.tgdd.vn/mwg-static/common/Category/b6/26/b62674c18cc7ec4de1de3670812af13d.png'" />
        <x-partial.filter.product.label-brand :text="'Chơi game'" />
        <x-partial.filter.product.label-brand :text="'Pin khủng'" />
    </div>
    <div class="quantity-label-sort">

    </div>
@endsection

@section('scripts')
    @parent
@endsection
