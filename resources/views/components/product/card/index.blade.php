@use('App\Enums\ModelMetaKey')
<div class="card-product">
    <!-- The whole future lies in uncertainty: live immediately. - Seneca -->
    <a href="{{ $url ?? null }}" onclick="return false">
        <div class="layout-top-tags">
            @isset($topTags)
                @foreach ($topTags as $topTag)
                    <span class="top-tag">{{ $topTag }}</span>
                @endforeach
            @endisset
        </div>

        @isset($thumbUrl)
            <div class="holder-img">
                <img class="thumb" alt="{{ $title ?? null }}"
                     src="{{ $thumbUrl }}">
                @if($bottomLeftStampUrl)
                    <img class="stamp bottom-left"
                         src="{{ $bottomLeftStampUrl }}">
                @endif
            </div>
        @endisset

        {{--        @isset($badge)--}}
        {{--            <div--}}
        {{--                class="layout-badge {{ $badgeBg }}">--}}
        {{--                <img class="badge"--}}
        {{--                     alt="{{ $badgeText ?? null }}"--}}
        {{--                     src="{{ $badgeIcon ?? null }}">--}}
        {{--                <span--}}
        {{--                    class="badge-text">{{ $badgeText }}</span>--}}
        {{--            </div>--}}
        {{--        @endisset--}}

        <div class="holder-product-name">
            <span class="product-name">{{ $title ?? null }}</span>
        </div>
        @isset($compareTags)
            <div class="layout-compare-tags">
                @foreach ($compareTags as $compareTag)
                    <span class="compare-tag">{{ $compareTag }}</span>
                @endforeach
            </div>
        @endisset

        {{--switch variant options buttons--}}
        {!! $slot ?? null !!}

        <div class="layout-price">
            <span class="price">{{ $price ?? null }}</span>
        </div>

        @isset($regularPrice)
            <div class="layout-regular-price">
                <span class="regular-price">
                    {{ $regularPrice }}
                </span>
                @if($price)
                    <span class="discount">{{ $discount ?? null }}</span>
                @endif
            </div>
        @endisset

        @isset($gift)
            <div class="layout-gift">
                Quà <span class="gift">{{ $gift }}</span>
            </div>
        @endisset

        @isset($rate)
            <div class="layout-rate">
                <span class="icon starred material-symbols-outlined">star</span>
                <span class="icon starred material-symbols-outlined">star</span>
                <span class="icon starred material-symbols-outlined">star</span>
                <span class="icon material-symbols-outlined">star</span>
                <span class="icon material-symbols-outlined">star</span>
                <span class="rate">178</span>
            </div>
        @endisset
    </a>
</div>
