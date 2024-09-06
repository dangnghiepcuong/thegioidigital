@extends('layouts.default')

@section('title', 'Trang chủ')
@section('large-banner')
    <div class="large-banner">
        <img width="1920" height="920"
            src="https://cdnv2.tgdd.vn/mwg-static/common/Banner/b8/ec/b8ec344dbac719a813fd59e83110ed5d.jpg" alt="Redmi 14C">
    </div>
@endsection

@section('content')
    <x-general.banner-area />
    <x-product.list.frame-list 
        :banner-link="'https://cdnv2.tgdd.vn/mwg-static/common/Campaign/a4/e1/a4e1828e317cf677b31d11fd9feaf39b.gif'" 
        :background-color="''" 
        :products-per-frame="12" 
        :btn-see-more="'Xem thêm sản phẩm'" 
    >
        <x-product.list.flash-sale/>
    </x-product.list.frame-list>

    <x-product.list.frame-list 
        :banner-link="'https://cdnv2.tgdd.vn/mwg-static/common/Banner/8e/d6/8ed6fa0d9f0c6a4ce81f9a44ec5989ac.png'" 
        :background-color="'background-color: #FED11D'" 
        :products-per-frame="5" 
        :btn-see-more="'Xem tất cả'" 
    >
        <x-product.list.deal-ngon/>
    </x-product.list.frame-list>

    <x-product.list.frame-list 
        :banner-link="'https://cdn.tgdd.vn/2024/07/campaign/Frame-1-1200x152.png'" 
        :background-color="'background-color: #910101'" 
        :products-per-frame="12" 
        :btn-see-more="'Xem thêm ĐỒNG HỒ GIÁ SỐC'" 
    >
        <x-product.list.dong-ho/>
    </x-product.list.frame-list>

@endsection

@section('scripts')
    @vite($viewsDir . '/trang-chu.js')
@endsection
