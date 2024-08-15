<!-- Knowing is not enough; we must apply. Being willing is not enough; we must do. - Leonardo da Vinci -->
@extends('layouts.default')

@section('styles')
    @vite($viewsDir . '/lich-su-mua-hang/dang-nhap.css')
@endsection

@section('title', 'Đăng nhập')

@section('content')
    <div class="layout-login-page">
        <div>
            <div class="banner">
                <img class="site-icon " src="https://cdn.tgdd.vn/2022/10/banner/TGDD-540x270.png">
            </div>
            <div class="layout-form-login">
                <form class="form-login" method="POST" action="{{ route('login.store') }}">
                    @csrf
                    <div class="form-title">
                        Tra cứu thông tin đơn hàng
                    </div>
                    <div class="layout-input .phone-number">
                        <span class="icon material-symbols-outlined">email</span>
                        <input name="email" id="email" class="input-phone-number" type="email"
                            placeholder="Nhập địa chỉ thư điện tử mua hàng">
                    </div>
                    @foreach ($errors->email as $error)
                        <span v-if="_get(authStore.errors, 'email')" class="error email">{{ $error }}</span>
                    @endforeach

                    <div class="layout-input .password">
                        <span class="icon material-symbols-outlined">password</span>
                        <input name="password" id="password" class="input-password" type="password"
                            placeholder="Nhập mật khẩu">
                    </div>
                    @foreach ($errors->password as $error)
                        <span v-if="_get(authStore.errors, 'password')" class="error password">{{ $error }}</span>
                    @endforeach

                    <div class="layout-input .submit">
                        <input type="submit" value="ĐĂNG NHẬP" class="btn-submit" @click="authStore.login(form)">
                    </div>
                    @foreach ($errors->all() as $error)
                        <span v-if="_get(authStore.errors, 'error')" class="error">{{ $error }}</span>
                        <br>
                    @endforeach
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
