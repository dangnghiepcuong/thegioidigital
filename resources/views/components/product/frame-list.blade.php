<!-- It is not the man who has too little, but the man who craves more, that is poor. - Seneca -->
<div class="layout-product" style="{{$backgroundColor}}">
    <div class="banner-product">
        <img width="1200" height="120" data-src="{{$bannerLink}}" class=" lazyloaded"
            alt="banner title flashsale 08:00 - 20:59 theme" src="{{$bannerLink}}">

        <div class="layout-clock-count-down">
        </div>
    </div>
    <x-dynamic-component :component="$productListComponent" />
    <div class="layout-btn-see-more">
        <a class="btn-link btn-see-more" href="">
            <span>{{ $btnSeeMore }}</span>
            <span class="icon material-symbols-outlined">arrow_forward_ios</span>
        </a>
    </div>
</div>
