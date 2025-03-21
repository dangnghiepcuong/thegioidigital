<?php

namespace App\View\Components\Product\Card;

use App\Enums\ModelMetaKey;
use App\Models\Product;
use App\Models\TermTaxonomy;
use Closure;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection as SupportCollection;
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
        $serializedBadge = get_meta_value($this->selectedVariantMeta, ModelMetaKey::BADGE);
        try {
            $badge = $serializedBadge ? unserialize($serializedBadge) : null;
            $badgeBg = $badge['product_attr_badge_background'] ?? null;
            $badgeText = $badge['product_attr_badge_text'] ?? null;
            $badgeIcon = $badge['product_attr_badge_icon_url'] ?? null;
        } catch (Exception $exception) {
            $badge = null;
            $badgeBg = null;
            $badgeText = null;
            $badgeIcon = null;
        }
        $serializedCompareTags = get_meta_value($this->selectedVariantMeta, ModelMetaKey::COMPARE_TAGS);
        try {
            $compareTags = $serializedCompareTags ? unserialize($serializedCompareTags) : null;
        } catch (Exception $exception) {
            $compareTags = [];
        }
        $price = get_meta($this->selectedVariantMeta, ModelMetaKey::PRICE);
        $regularPrice = get_meta($this->selectedVariantMeta, ModelMetaKey::REGULAR_PRICE);
        $discount = floor(
                (($regularPrice ? $regularPrice->value : 0) - ($price ? $price->value : 0))
                / ($regularPrice ? $regularPrice->value : 1)
                * 100
            ) . '%';
        $gift = get_meta($this->selectedVariantMeta, ModelMetaKey::GIFT);
        $rate = get_meta_value($this->selectedVariantMeta, 'rate');

        return view('components.product.card.index', [
            'topTags' => $topTags,
            'thumbUrl' => $thumbUrl,
            'title' => $title,
            'bottomLeftStampUrl' => $bottomLeftStampUrl,
            'badge' => $badge,
            'badgeBg' => $badgeBg,
            'badgeText' => $badgeText,
            'badgeIcon' => $badgeIcon,
            'compareTags' => $compareTags,
            'price' => $price ? $price->getCurrency() : null,
            'regularPrice' => $regularPrice ? $regularPrice->getCurrency() : null,
            'discount' => $discount,
            'gift' => $gift ? $gift->getCurrency() : null,
            'rate' => $rate,
        ]);
    }
}
