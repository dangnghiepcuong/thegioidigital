<!-- Because you are alive, everything is possible. - Thich Nhat Hanh -->
@extends('layouts.product.index')
@section('title', 'Điện thoại smartphone')

@section('styles')
    @parent
    @vite($viewsDir . '/product/dtdd.css')
@endsection
@use('App\Enums\ModelMetaKey')
@section('content')
    <div class="layout-path-bar">
        <div class="address">Điện thoại</div>
        <div class="address im-here">Điện thoại iPhone (Apple)</div>
    </div>

    <div class="layout-product-title">
        <h3>Điện thoại iPhone 16 128GB</h3>
    </div>
@endsection

@section('scripts')
    @parent
@endsection
