<?php

namespace App\View\Components\Product\Card;

use App\Enums\ModelMetaKey;
use App\Models\Product;
use App\Models\TermTaxonomy;
use Closure;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Component;

class Index extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public ?Product           $product,
        public ?SupportCollection $productVariants,
        public ?TermTaxonomy      $selectedTermTaxonomy,
        public ?SupportCollection $selectedVariantMeta,
        public ?string            $url,
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $serializedTogTags = get_meta_value($this->selectedVariantMeta, ModelMetaKey::TOP_TAGS);
        try {
            $topTags = $serializedTogTags ? unserialize($serializedTogTags) : null;
        } catch (Exception $exception) {
            $topTags = [];
        }
        $thumbUrl = get_meta_value($this->selectedVariantMeta, ModelMetaKey::THUMB_URL);
        $title = $this->product->title ?? null;
        $bottomLeftStampUrl = get_meta_value($this->selectedVariantMeta, ModelMetaKey::BOTTOM_LEFT_STAMP_URL);

        $badgeBgStyle = get_meta_value($this->selectedVariantMeta, ModelMetaKey::BADGE_BACKGROUND_STYLE);
        if ($badgeBgStyle) {
            $badgeBgColor1 = get_meta_value($this->selectedVariantMeta, ModelMetaKey::BADGE_BACKGROUND_COLOR_1);
            $badgeBgColor2 = get_meta_value($this->selectedVariantMeta, ModelMetaKey::BADGE_BACKGROUND_COLOR_2);
            $badgeBgColorReverse = get_meta_value($this->selectedVariantMeta, ModelMetaKey::BADGE_BACKGROUND_COLOR_REVERSE);
            if ($badgeBgColorReverse) {
                [$badgeBgColor1, $badgeBgColor2] = [$badgeBgColor2, $badgeBgColor1];
            }
            $badge = Blade::render('<x-product.card.badge-template
            :background-style="$badgeBgStyle ?? null"
            :background-color-1="$badgeBgColor1 ?? null"
            :background-color-2="$badgeBgColor2 ?? null"
            :background-url="$badgeBgUrl ?? null"
            :icon-url="$badgeIconUrl ?? null"
            :text-color="$badgeTextColor ?? null"
            :text="$badgeText ?? null"/>', [
                'badgeBgStyle' => get_meta_value($this->selectedVariantMeta, ModelMetaKey::BADGE_BACKGROUND_STYLE),
                'badgeBgColor1' => $badgeBgColor1,
                'badgeBgColor2' => $badgeBgColor2,
                'badgeBgUrl' => get_meta_value($this->selectedVariantMeta, ModelMetaKey::BADGE_BACKGROUND_URL),
                'badgeIconUrl' => get_meta_value($this->selectedVariantMeta, ModelMetaKey::BADGE_ICON_URL),
                'badgeText' => get_meta_value($this->selectedVariantMeta, ModelMetaKey::BADGE_TEXT),
                'badgeTextColor' => get_meta_value($this->selectedVariantMeta, ModelMetaKey::BADGE_TEXT_COLOR),
            ]);
        } else {
            $badge = null;
        }

        $serializedCompareTags = get_meta_value($this->selectedVariantMeta, ModelMetaKey::COMPARE_TAGS);
        try {
            $compareTags = $serializedCompareTags ? unserialize($serializedCompareTags) : null;
        } catch (Exception $exception) {
            $compareTags = [];
        }
        $price = get_meta($this->selectedVariantMeta, ModelMetaKey::PRICE);
        $regularPrice = get_meta($this->selectedVariantMeta, ModelMetaKey::REGULAR_PRICE);
        if (is_null($regularPrice) && is_null($price)) {
            $discount = floor(
                    (($regularPrice ? $regularPrice->value : 0) - ($price ? $price->value : 0))
                    / ($regularPrice ? $regularPrice->value : 1)
                    * 100
                ) . '%';
        } else {
            $discount = null;
        }
        $gift = get_meta($this->selectedVariantMeta, ModelMetaKey::GIFT);
        $rate = get_meta_value($this->selectedVariantMeta, 'rate');

        return view('components.product.card.index', [
            'topTags' => $topTags,
            'thumbUrl' => $thumbUrl,
            'title' => $title,
            'bottomLeftStampUrl' => $bottomLeftStampUrl,
            'badge' => $badge,
            'compareTags' => $compareTags,
            'price' => $price ? $price->getCurrency() : null,
            'regularPrice' => $regularPrice ? $regularPrice->getCurrency() : null,
            'discount' => $discount,
            'gift' => $gift ? $gift->getCurrency() : null,
            'rate' => $rate,
        ]);
    }
}
