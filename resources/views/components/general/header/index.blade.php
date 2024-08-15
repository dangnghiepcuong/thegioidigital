<div id="header-top-slider" class="layout-slider">
    <div class="slider advertise">
        <div class="nav">
            <div class="prev" onclick="navigateSlider('#frame-slider-top-long-banner', 'left', 0, 1)">
                <div class="arrow arrow-left"></div>
            </div>
            <div class="next" onclick="navigateSlider('#frame-slider-top-long-banner', 'right', 0, 1)">
                <div class="arrow arrow-right"></div>
            </div>
        </div>
        <div class="box-slider-relative">
            <div class="frame-slider" id="frame-slider-top-long-banner">
                <ul class="slider" id="slider-top-long-banner">
                    <li class="slide">
                        <a href="">
                            <img width="1200" height="44" loading="lazy" class="owl-lazy lazyloaded"
                                data-src="//cdn.tgdd.vn/2024/06/banner/1200x44-1200x44-1.jpg" alt="honor"
                                src="//cdn.tgdd.vn/2024/06/banner/1200x44-1200x44-1.jpg">
                        </a>
                    </li>
                    <li class="slide">
                        <a href="">
                            <img width="1200" height="44" loading="lazy" class="owl-lazy lazyloaded"
                                data-src="//cdn.tgdd.vn/2024/04/banner/dandau-1200-44-1200x44.png" alt="TZ GTQ"
                                src="//cdn.tgdd.vn/2024/04/banner/dandau-1200-44-1200x44.png">
                        </a>
                    </li>
                    <li class="slide">
                        <a href="">
                            <img width="1200" height="44" loading="lazy" class="owl-lazy lazyloaded"
                                data-src="//cdn.tgdd.vn/2024/06/banner/1200x44-1200x44-1.jpg" alt="honor"
                                src="//cdn.tgdd.vn/2024/06/banner/1200x44-1200x44-1.jpg">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div id="header" class="layout-header">
    <div class="layout-header-top">
        <div>
            <a href="{{ route('homepage') }}" class="header-logo"><i class="iconnewglobal-logo"></i></a>
            <a class="btn-link check-inventory" onclick="popupLocationSelect('show')">
                <span>Xem giá, tồn kho tại:</span>
                <span class="arrow-drop-down material-symbols-outlined">arrow_drop_down</span>
                <span class="address">t.t. Dầu Tiếng, h. Dầu Tiếng, t. Bình Dương</span>
            </a>
            <div class="bar-search">
                <input class="input-search inputtext" placeholder="Bạn tìm gì" />
                <div class="layout-icon-search">
                    <span class="icon material-symbols-outlined">
                        search
                    </span>
                </div>
            </div>
            <a class="btn-link order-history" href="">
                @if (auth()->user())
                    <span>
                        Đơn hàng
                        <strong class="customer-name">{{ auth()->user()->first_name }}</strong>
                    </span>
                @else
                    <span v-else>Tài khoản & Đơn hàng</span>
                @endif
            </a>
            <a class="btn-link cart">
                <span class="icon material-symbols-outlined">garden_cart</span>
                <span>Giỏ hàng</span>
            </a>

            <div class="list-text-link">
                <a class="text-link news">
                    24h
                    <br>
                    <span>Công nghệ</span>
                </a>
                <div class="vertical-border-line"></div>
                <a class="text-link qna">
                    Hỏi đáp
                </a>
                <div class="vertical-border-line"></div>
                <a class="text-link game-app">
                    Game App
                </a>
            </div>
        </div>
    </div>
    <div class="layout-header-bottom">
        <div>
            <x-general.super-menu.index :menu-items="$menuItems" />
        </div>
    </div>
</div>
<x-general.popup.location-select.index />
