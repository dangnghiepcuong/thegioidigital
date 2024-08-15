@extends('layouts.default')

@section('styles')
    @vite($viewsDir . '/layouts/lich-su-mua-hang/index.css')
@endsection

@section('content')
    <div id="page-order-history">
        <div class="layout-orders-history">
            <div class="layout-panel">
                <div class="customer-name">{{ auth()->user()->last_name }} <span
                        class="title"><strong>{{ auth()->user()->first_name }}</strong></span></div>
                <ul class="panel-list-item">
                    <li class="item selected">
                        <a href="{{ route('lich-su-mua-hang.index') }}">
                            <span class="material-symbols-outlined icon order selected">receipt_long</span>
                            <span>Đơn hàng đã mua</span>
                        </a>
                    </li>
                    <li class="item">
                        <a href="{{ route('lich-su-mua-hang.thong-tin-ca-nhan') }}">
                            <span class="material-symbols-outlined icon personal-info">contact_emergency</span>
                            <span>Thông tin và sổ địa chỉ</span>
                        </a>
                    </li>
                </ul>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <input class="btn btn-logout" type="submit" value="Đăng Xuất"/>
                </form>
            </div>
            @yield('sub-content')
        </div>
    </div>
@endsection

@section('scripts')
@endsection
