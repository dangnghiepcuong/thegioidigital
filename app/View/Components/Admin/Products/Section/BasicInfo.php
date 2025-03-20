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
        $badge = get_meta_value($this->productMeta, ModelMetaKey::BADGE) ?? null;
        $badgeBg = $badge ? unserialize($badge)['product_attr_badge_background'] : null;
        $badgeIcon = $badge ? unserialize($badge)['product_attr_badge_icon_url'] : null;
        $badgeText = $badge ? unserialize($badge)['product_attr_badge_text'] : null;

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
            'badge' => $badge,
            'badgeBg' => $badgeBg,
            'badgeIcon' => $badgeIcon,
            'badgeText' => $badgeText,
            'compareTags' => $areaTextCompareTags,
            'regularPrice' => $regularPrice,
            'price' => $price,
            'gift' => $gift,
        ]);
    }
}
