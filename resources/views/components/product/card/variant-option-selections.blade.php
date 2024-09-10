@if (isset($termTaxonomy) && isset($termName) && isset($termTaxonomyVariants))
    <div class="layout-attribute-options">
        @foreach ($termTaxonomyVariants as $variant)
            <span data-slug="{{ $variant->slug }}" @class([
                'btn',
                'btn-selection',
                'attribute-option',
                'selected-option' =>
                    get_meta_value($variant->productMetaInCardView, $termTaxonomy) ===
                    $termName,
            ])
                data-term-name="{{ get_meta_value($variant->productMetaInCardView, $termTaxonomy) }}"
                data-taxonomy="{{ $termTaxonomy }}">
                {{ get_meta_value($variant->productMetaInCardView, $termTaxonomy) }}
            </span>
        @endforeach
    </div>
@endif
