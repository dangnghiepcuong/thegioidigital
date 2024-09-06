<a class="item-brand">
    @if (isset($brandLogoLink))
        <img src="{{ $brandLogoLink }}" class="logo">
    @endif
    @if (isset($text))
        {{ $text }}
    @endif
</a>
