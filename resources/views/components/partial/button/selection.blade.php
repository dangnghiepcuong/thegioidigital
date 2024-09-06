<div class="btn btn-selection">
    @if (isset($logoLink))
        <img src="{{ $logoLink }}" class="logo">
    @endif
    @if (isset($imgLink))
        <img src="{{ $imgLink }}" class="img">
        <br>
    @endif
    @if (isset($text))
        <span class="text">
            {{ $text }}
        </span>
    @endif
</div>
