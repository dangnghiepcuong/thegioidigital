<!-- Live as if you were to die tomorrow. Learn as if you were to live forever. - Mahatma Gandhi -->
@use(App\Enums\ModelMetaKey)
<div class="form-item">
    <label for="form-badge-bg-style">{{ __('product_meta.product_attr_badge_background_style') }}</label>
    <select name="{{ ModelMetaKey::BADGE_BACKGROUND_STYLE }}"
            id="product-attr-badge-background-style"
            class="input-field">
        @if(old(ModelMetaKey::BADGE_BACKGROUND_STYLE))
            <option value="{{ old(ModelMetaKey::BADGE_BACKGROUND_STYLE) }}">
                {{ __('product_meta.product_attr_badge_background_style_options.' . old(ModelMetaKey::BADGE_BACKGROUND_STYLE)) }}
            </option>
            <option value=""></option>
            @foreach ($badgeBackgroundStylesEnum as $badgeBgStyleEnum)
                <option value="{{ $badgeBgStyleEnum }}">
                    {{ __("product_meta.product_attr_badge_background_style_options.$badgeBgStyleEnum") }}
                </option>
            @endforeach
        @elseif($backgroundStyle)
            <option value="{{ $backgroundStyle }}">
                {{ __("product_meta.product_attr_badge_background_style_options.$backgroundStyle") }}
            </option>
            <option value=""></option>
            @foreach ($badgeBackgroundStylesEnum as $badgeBgStyleEnum)
                <option value="{{ $badgeBgStyleEnum }}">
                    {{ __("product_meta.product_attr_badge_background_style_options.$badgeBgStyleEnum") }}
                </option>
            @endforeach
        @else
            <option value=""></option>
            @foreach ($badgeBackgroundStylesEnum as $badgeBgStyleEnum)
                <option value="{{ $badgeBgStyleEnum }}">
                    {{ __("product_meta.product_attr_badge_background_style_options.$badgeBgStyleEnum") }}
                </option>
            @endforeach
        @endif
    </select>
</div>
<div class="form-item demo-attribute d-none">
    <label for="form-badge-bg-color-1">
        {{ __('product_meta.' . ModelMetaKey::BADGE_BACKGROUND_COLOR_1) }}
    </label>
    <input name="{{ ModelMetaKey::BADGE_BACKGROUND_COLOR_1 }}"
           type="color" id="form-badge-bg-color-1"
           value="{{ old(ModelMetaKey::BADGE_BACKGROUND_COLOR_1) ?? $backgroundColor1 ?? null }}">
</div>
<div class="form-item demo-attribute d-none">
    <label for="form-badge-bg-color-2">
        {{ __('product_meta.' . ModelMetaKey::BADGE_BACKGROUND_COLOR_2) }}
    </label>
    <input name="product_attr_badge_background_color_2"
           type="color" id="form-badge-bg-color-2"
           value="{{ old(ModelMetaKey::BADGE_BACKGROUND_COLOR_2) ?? $backgroundColor2 ?? null }}">
</div>
<div class="form-item demo-attribute d-none">
    <label
        for="form-badge-bg-color-reverse">{{ __('product_meta.' . ModelMetaKey::BADGE_BACKGROUND_COLOR_REVERSE) }}</label>
    <input name="{{ ModelMetaKey::BADGE_BACKGROUND_COLOR_REVERSE }}"
           type="checkbox" id="form-badge-bg-color-reverse"
           value="true"
        {{ old(ModelMetaKey::BADGE_BACKGROUND_COLOR_REVERSE) ? 'checked' : null }}>
</div>
<div class="form-item demo-attribute d-none">
    <label for="form-badge-bg-url">{{ __('product_meta.' . ModelMetaKey::BADGE_BACKGROUND_URL) }}</label>
    <input name="{{ ModelMetaKey::BADGE_BACKGROUND_URL }}"
           type="url" id="form-badge-bg-url"
           value="{{ old(ModelMetaKey::BADGE_BACKGROUND_URL) ?? $backgroundUrl ?? null }}"
           class="input-field">
</div>
<div class="form-item demo-attribute d-none">
    <label for="form-badge-icon-url">{{ __('product_meta.' . ModelMetaKey::BADGE_ICON_URL) }}</label>
    <input name="{{ ModelMetaKey::BADGE_ICON_URL }}"
           type="url" id="form-badge-icon-url"
           value="{{ old(ModelMetaKey::BADGE_ICON_URL) ?? $iconUrl ?? null }}"
           class="input-field">
</div>
<div class="form-item demo-attribute d-none">
    <label for="form-badge-text">{{ __('product_meta.' . ModelMetaKey::BADGE_TEXT) }}</label>
    <input name="{{ ModelMetaKey::BADGE_TEXT }}"
           type="text" id="form-badge-text"
           value="{{ old(ModelMetaKey::BADGE_TEXT) ?? $text ?? null }}"
           class="input-field">
</div>
<div class="form-item demo-attribute d-none">
    <label for="form-badge-text-color">{{ __('product_meta.' . ModelMetaKey::BADGE_TEXT_COLOR) }}</label>
    <input name="{{ ModelMetaKey::BADGE_TEXT_COLOR }}"
           type="color" id="form-badge-text-color"
           value="{{ old(ModelMetaKey::BADGE_TEXT_COLOR) ?? $textColor ?? null }}">
</div>

@pushonce('scripts')
    @vite($viewsDir . '/components/admin/products/section/badge-template.js')
@endpushonce
