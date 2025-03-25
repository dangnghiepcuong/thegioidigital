<?php

namespace App\View\Components\Admin\Products\Section;

use App\Enums\ModelMetaKey;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class BasicInfo extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        private ?Collection $productMeta
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $serializedTopTags = get_meta_value($this->productMeta, ModelMetaKey::TOP_TAGS);
        $topTags = $serializedTopTags ? unserialize($serializedTopTags) : [];
        $areaTextTopTags = '';
        foreach ($topTags as $topTag) {
            $areaTextTopTags .= "$topTag\n";
        }

        $thumbUrl = get_meta_value($this->productMeta, ModelMetaKey::THUMB_URL) ?? null;
        $bottomLeftStampUrl = get_meta_value($this->productMeta, ModelMetaKey::BOTTOM_LEFT_STAMP_URL) ?? null;
        $topRightStampUrl = get_meta_value($this->productMeta, ModelMetaKey::TOP_RIGHT_STAMP_URL) ?? null;

        $badgeBgStyle = get_meta_value($this->productMeta, ModelMetaKey::BADGE_BACKGROUND_STYLE) ?? null;
        if ($badgeBgStyle) {
            $badgeBgColor1 = get_meta_value($this->productMeta, ModelMetaKey::BADGE_BACKGROUND_COLOR_1) ?? null;
            $badgeBgColor2 = get_meta_value($this->productMeta, ModelMetaKey::BADGE_BACKGROUND_COLOR_2) ?? null;
            $badgeBgUrl = get_meta_value($this->productMeta, ModelMetaKey::BADGE_BACKGROUND_URL) ?? null;
            $badgeIconUrl = get_meta_value($this->productMeta, ModelMetaKey::BADGE_ICON_URL) ?? null;
            $badgeText = get_meta_value($this->productMeta, ModelMetaKey::BADGE_TEXT) ?? null;
            $badgeTextColor = get_meta_value($this->productMeta, ModelMetaKey::BADGE_TEXT_COLOR) ?? null;
        }

        $serializedCompareTags = get_meta_value($this->productMeta, ModelMetaKey::COMPARE_TAGS);
        $compareTags = $serializedCompareTags ? unserialize($serializedCompareTags) : [];
        $areaTextCompareTags = '';
        foreach ($compareTags as $compareTag) {
            $areaTextCompareTags .= "$compareTag\n";
        }
        $regularPrice = get_meta_value($this->productMeta, ModelMetaKey::REGULAR_PRICE);
        $price = get_meta_value($this->productMeta, ModelMetaKey::PRICE);
        $gift = get_meta_value($this->productMeta, ModelMetaKey::GIFT);

        return view('components.admin.products.section.basic-info', [
            'topTags' => $areaTextTopTags,
            'thumbUrl' => $thumbUrl,
            'bottomLeftStampUrl' => $bottomLeftStampUrl,
            'topRightStampUrl' => $topRightStampUrl,
            'badgeBgStyle' => $badgeBgStyle,
            'badgeBgColor1' => $badgeBgColor1 ?? null,
            'badgeBgColor2' => $badgeBgColor2 ?? null,
            'badgeBgUrl' => $badgeBgUrl ?? null,
            'badgeIconUrl' => $badgeIconUrl ?? null,
            'badgeText' => $badgeText ?? null,
            'badgeTextColor' => $badgeTextColor ?? null,
            'compareTags' => $areaTextCompareTags,
            'regularPrice' => $regularPrice,
            'price' => $price,
            'gift' => $gift,
        ]);
    }
}
