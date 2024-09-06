@extends('layouts.default')

@section('styles')
    @vite($viewsDir . '/layouts/product/index.css')
@endsection

@section('content')
    <div id="top-banner-product" class="top-banner-product">
        <div class="top-banner-product-slider">
            <div class="nav-slider">
                <div class="prev" onclick="navigateSlider('#frame-slider-top-banner-product', 'left', 0, 1)">
                    <div class="arrow arrow-left"></div>
                </div>
                <div class="next" onclick="navigateSlider('#frame-slider-top-banner-product', 'right', 0, 1)">
                    <div class="arrow arrow-right"></div>
                </div>
            </div>
            <div class="frame-slider-outer">
                <div id="frame-slider-top-banner-product" class="frame-slider" id="frame-slider-top-long-banner">
                    <ul class="slider" id="slider-top-long-banner">
                        <li class="slide">
                            <a href="">
                                <img width="800" height="200"
                                    src="https://cdnv2.tgdd.vn/mwg-static/common/Banner/48/32/4832bf1befa504799d17c3cdd580f864.jpg"
                                    alt="2G-4G">
                            </a>
                        </li>
                        <li class="slide">
                            <a href="">
                                <img width="800" height="200" loading="lazy" class="owl-lazy lazyloaded"
                                    data-src="//cdn.tgdd.vn/2024/07/banner/1200x300--1--1200x300.jpg" alt="iPhone 13"
                                    src="//cdn.tgdd.vn/2024/07/banner/1200x300--1--1200x300.jpg" style="opacity: 1;">
                            </a>
                        </li>
                        <li class="slide">
                            <a href="">
                                <img width="800" height="200"
                                    src="https://cdnv2.tgdd.vn/mwg-static/common/Banner/0f/6a/0f6afd410f08b8addfd99e59d9a0e9a4.jpg"
                                    alt="SAMSUNG">
                            </a>
                        </li>
                        <li class="slide">
                            <a href="">
                                <img width="800" height="200"
                                    src="https://cdnv2.tgdd.vn/mwg-static/common/Banner/e8/db/e8db3ec9631f05932a36d39115b59baf.png"
                                    alt="oppo reno11 f 5g">
                            </a>
                        </li>
                        <li class="slide">
                            <a href="">
                                <img width="800" height="200"
                                    src="https://cdnv2.tgdd.vn/mwg-static/common/Banner/bf/f2/bff2a9055ee47671fe555c67ce5f0f31.png"
                                    alt="mi">
                            </a>
                        </li>
                        <li class="slide">
                            <a href="">
                                <img width="800" height="200"
                                    src="https://cdnv2.tgdd.vn/mwg-static/common/Banner/7b/9f/7b9f26342cf7141a349dfd5c23c55d90.png"
                                    alt="Vivo Y100">
                            </a>
                        </li>
                        <li class="slide">
                            <a href="">
                                <img width="800" height="200"
                                    src="https://cdnv2.tgdd.vn/mwg-static/common/Banner/a0/d8/a0d862ccf6c61fd74cffc4c327aafd21.png"
                                    alt="c65">
                            </a>
                        </li>
                        <li class="slide">
                            <a href="">
                                <img width="800" height="200"
                                    src="https://cdnv2.tgdd.vn/mwg-static/common/Banner/9d/ab/9dab9a8bfbb2c8f10a390251b357bf64.jpg"
                                    alt="HONOR">
                            </a>
                        </li>
                        <li class="slide">
                            <a href="">
                                <img width="800" height="200" loading="lazy" class="owl-lazy lazyloaded"
                                    data-src="//cdn.tgdd.vn/2024/06/banner/Trang-cate-TCL-505-1200x300.jpg" alt="TCL"
                                    src="//cdn.tgdd.vn/2024/06/banner/Trang-cate-TCL-505-1200x300.jpg" style="opacity: 1;">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="promote-banner">
            <div class="promote-item">
                <a aria-label="slide" data-cate="42" data-place="1555" rel="nofollow"
                    href="https://www.thegioididong.com/dtdd/samsung-galaxy-m15-5g-4gb">
                    <img src="//cdn.tgdd.vn/2024/07/banner/Sticky-M15-390x97.jpg" alt="Samsung">
                </a>
            </div>
            <div class="promote-item">
                <a aria-label="slide" data-cate="42" data-place="1555" rel="nofollow"
                    href="https://www.thegioididong.com/dtdd/oppo-a38-6gb">
                    <img src="https://cdnv2.tgdd.vn/mwg-static/common/Banner/3c/cb/3ccb462737f607d95f48eb141cab231e.png"
                        alt="OPPO">
                </a>
            </div>
        </div>
    </div>
    <x-partial.filter.product />
@endsection

@push('scripts')
    @vite($viewsDir . '/layouts/product/index.js')
@endPush