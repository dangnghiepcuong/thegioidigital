<!-- Well begun is half done. - Aristotle -->
<div id="{{ $id ?? null }}" class="layout-btn-see-more">
    <a class="btn-see-more" {{ isset($btnLink) ? "href=\"$btnLink\"" : null }} onclick="{{ $onclick ?? null }}">
        <input type="hidden" name="next_page" value="{{ $nextPage ?? null }}">
        <input type="hidden" name="last_page" value="{{ $lastPage ?? null }}">
        <input type="hidden" name="total" value="{{ $total ?? null }}">
        <span class="btn-text">{{ $btnSeeMore ?? null }}</span>
        <span class="icon material-symbols-outlined">{{ $googleIconName ?? null }}</span>
    </a>
</div>
