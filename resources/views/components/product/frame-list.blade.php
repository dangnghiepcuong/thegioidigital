<!-- It is not the man who has too little, but the man who craves more, that is poor. - Seneca -->
<div class="layout-product" style="{{ $backgroundColor }}">
    <div class="banner-product">
        <img width="1200" height="120" data-src="{{ $bannerLink }}" class=" lazyloaded"
            alt="banner title flashsale 08:00 - 20:59 theme" src="{{ $bannerLink }}">

        <div class="layout-clock-count-down">
        </div>
    </div>
    <x-dynamic-component :component="$productListComponent" />
    <div class="layout-btn-see-more">
        <x-general.button.button-see-more
            :btn-see-more="$btnSeeMore"
            :google-icon-name="'arrow_forward_ios'"
        />
    </div>
</div>
