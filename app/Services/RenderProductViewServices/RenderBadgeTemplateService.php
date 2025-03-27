<?php

namespace App\Services\RenderProductViewServices;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;

class RenderBadgeTemplateService
{
    public function __construct()
    {
        //
    }
    public function __invoke(Request $request): ?string
    {
        if ($request->product_attr_badge_background_style == null) {
            return null;
        }

        return Blade::render('<x-product.card.badge-template
        :background-style="$backgroundStyle"
        :background-color-1="$backgroundColor1"
        :background-color-2="$backgroundColor2"
        :background-color-reverse="$backgroundColorReverse"
        :background-url="$backgroundUrl"
        :icon-url="$iconUrl"
        :text="$text"
        :text-color="$textColor"/>', [
            'backgroundStyle' => $request->product_attr_badge_background_style,
            'backgroundColor1' => $request->product_attr_badge_background_color_1,
            'backgroundColor2' => $request->product_attr_badge_background_color_2,
            'backgroundColorReverse' => $request->product_attr_badge_background_color_reverse,
            'backgroundUrl' => $request->product_attr_badge_background_url,
            'iconUrl' => $request->product_attr_badge_icon_url,
            'text' => $request->product_attr_badge_text,
            'textColor' => $request->product_attr_badge_text_color,
        ]);
    }
}
