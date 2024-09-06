@push('styles')
    @vite($viewsDir . '/components/general/banner-area/index.css')
@endPush

<div id="banner-area-slider" class="layout-slider">
    <div>
        <div class="frame-slider-outer">
            <div class="frame-slider" id="frame-slider-dual-banner">
                <ul class="slider" id="slider-dual-banner">
                    <li class="slide">
                        <a href="">
                            <img src="https://cdnv2.tgdd.vn/mwg-static/common/Banner/13/10/1310ee5eccaca4942ca21336e511bdd5.jpg"
                                alt="SAMSUNG">
                        </a>
                    </li>
                    <li class="slide">
                        <a href="">
                            <img src="https://cdnv2.tgdd.vn/mwg-static/common/Banner/5e/13/5e1351684bfec3771489d03df82389af.png"
                                alt="R12">
                        </a>
                    </li>
                    <li class="slide">
                        <a href="">
                            <img loading="lazy" class="owl-lazy lazyloaded"
                                src="//cdn.tgdd.vn/2024/07/banner/Nha-via-Doi-diem-720x220-720x220-1.png"
                                alt="Laptop">
                        </a>
                    </li>
                    <li class="slide">
                        <a href="">
                            <img loading="lazy" class="owl-lazy lazyloaded"
                                src="https://cdnv2.tgdd.vn/mwg-static/common/Banner/3d/04/3d04157a765d043fe2f760625ca482a5.png"
                                alt="realme C65">
                        </a>
                    </li>
                    <li class="slide">
                        <a href="">
                            <img src="https://cdnv2.tgdd.vn/mwg-static/common/Banner/12/b4/12b462d8e4ff3909414d3cf648c75620.png"
                                alt="iPhone 12">
                        </a>
                    </li>
                    <li class="slide">
                        <a href="">
                            <img src="https://cdnv2.tgdd.vn/mwg-static/common/Banner/9d/53/9d531bfccfd975c12409024212b262e9.png"
                                alt="CASIO điện tử">
                        </a>
                    </li>
                    <li class="slide">
                        <a href="">
                            <img loading="lazy" class="owl-lazy lazyloaded"
                                src="https://cdnv2.tgdd.vn/mwg-static/common/Banner/1c/c9/1cc9cb444fa6bf7d101e1352f8797d23.png"
                                alt="TAI NGHE AVA">
                        </a>
                    </li>
                    <li class="slide">
                        <a href="">
                            <img src="https://cdnv2.tgdd.vn/mwg-static/common/Banner/94/89/948949fadc1637ff4dbf8e5d88319cfe.png"
                                alt="y28">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="layout-nav-slider" id="nav-slider-dual-banner">
            <div class="prev" onclick="navigateSlider('#frame-slider-dual-banner', 'left', 0, 2)">
                <span class="icon material-symbols-outlined">arrow_back_ios</span>
            </div>
            <div class="next" onclick="navigateSlider('#frame-slider-dual-banner', 'right', 0, 2)">
                <span class="icon material-symbols-outlined">arrow_forward_ios</span>
            </div>
        </div>
    </div>
</div>
<div id="banner-area-campaign-cards" class="layout-campaign-cards">
    <ul class="campaign-cards">
        <li class="card">
            <a href="">
                <img data-src="https://cdn.tgdd.vn/content/Frame427320037--1--min-120x120.gif"
                    class=" ls-is-cached lazyloaded" alt="Đổi 2G Lên<br>Smartphone 4G"
                    src="https://cdn.tgdd.vn/content/Frame427320037--1--min-120x120.gif">
                <span>
                    Đổi 2G Lên<br>Smartphone 4G
                </span>
            </a>
        </li>
        <li class="card">
            <a href="">
                <img data-src="https://cdn.tgdd.vn/content/icon-100x100-36.png" class=" ls-is-cached lazyloaded"
                    alt="Đồng hồ<br>sale từ 177k" src="https://cdn.tgdd.vn/content/icon-100x100-36.png">
                <span>
                    Đồng hồ<br>Sale từ 177k
                </span>
            </a>
        </li>
        <li class="card">
            <a href="">
                <img data-src="https://cdnv2.tgdd.vn/mwg-static/common/Common/94/23/94239ebc350756fb830d10abbced2c78.png"
                    class=" ls-is-cached lazyloaded" alt="Laptop sinh viên <br>Giảm đến 3Triệu"
                    src="https://cdnv2.tgdd.vn/mwg-static/common/Common/94/23/94239ebc350756fb830d10abbced2c78.png">
                <span>
                    Laptop sinh viên <br>Giảm đến 3Triệu
                </span>
            </a>
        </li>
        <li class="card">
            <a href="">
                <img width="50" height="50"
                    data-src="https://cdnv2.tgdd.vn/mwg-static/common/Common/cd/00/cd00c1ecb6ada48381f78c9f66b5886f.png"
                    class=" ls-is-cached lazyloaded" alt="Giảm Đến<br>80%++"
                    src="https://cdnv2.tgdd.vn/mwg-static/common/Common/cd/00/cd00c1ecb6ada48381f78c9f66b5886f.png">
                <span>
                    Giảm đến<br>80%++
                </span>
            </a>
        </li>
    </ul>
</div>
<div id="banner-area-banner-topzone" class="banner-topzone">
    <a href="">
        <img width="1200" height="100"
            src="https://cdnv2.tgdd.vn/mwg-static/common/Banner/e0/dc/e0dc2ba2d739792edb8d7a652e697b21.png"
            alt="Promote iPhone 15">
    </a>
</div>
