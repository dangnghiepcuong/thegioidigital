@extends('layouts.default')

@section('styles')
    @vite($viewsDir . '/components/general/banner-area/index.css')
    @vite($viewsDir . '/components/product/frame-list.css')
    @vite($viewsDir . '/components/product/list/flash-sale.css')
    @vite($viewsDir . '/components/product/list/deal-ngon.css')
    @vite($viewsDir . '/components/product/list/dong-ho.css')
@endsection

@section('title', 'Homepage')
@section('large-banner')
    <div class="large-banner">
        <img width="1920" height="920"
            src="https://cdnv2.tgdd.vn/mwg-static/common/Banner/8e/9d/8e9db41f5835a8b1a0d93308dc1952f1.png" alt="OPPO">
    </div>
@endsection

@section('content')
    <x-general.banner-area></x-general.banner-area>
    <x-product.frame-list 
        :banner-link="'https://cdnv2.tgdd.vn/mwg-static/common/Campaign/a4/e1/a4e1828e317cf677b31d11fd9feaf39b.gif'" 
        :background-color="''" 
        :product-list-component="'product.list.flash-sale'" 
        :products-per-frame="12" 
        :btn-see-more="'Xem thêm sản phẩm'" 
    />

    <x-product.frame-list 
        :banner-link="'https://cdnv2.tgdd.vn/mwg-static/common/Banner/69/fe/69fee98f7bf4d108b3f3cbd58dd9f94a.png'" 
        :background-color="'background-color: #F29202'" 
        :product-list-component="'product.list.deal-ngon'" 
        :products-per-frame="5" 
        :btn-see-more="'Xem tất cả'" 
    />

    <x-product.frame-list 
        :banner-link="'https://cdn.tgdd.vn/2024/07/campaign/Frame-1-1200x152.png'" 
        :background-color="'background-color: #910101'" 
        :product-list-component="'product.list.dong-ho'" 
        :products-per-frame="12" 
        :btn-see-more="'Xem thêm ĐỒNG HỒ GIÁ SỐC'" 
    />

@endsection

@section('scripts')
    @vite($jsDir . '/trang-chu.js')
@endsection
