@if (isset($termTaxonomy) && isset($termName) && isset($termTaxonomyVariants))
    <div class="layout-attribute-options">
        @foreach ($termTaxonomyVariants as $termTaxonomyVariant)
            <span data-slug="{{ $termTaxonomyVariant->slug }}" @class([
                'btn',
                'btn-selection',
                'attribute-option',
                'selected-option' =>
                    get_meta_value($termTaxonomyVariant->productMetaInCardView, $termTaxonomy) ===
                    $termName,
            ])
                data-link="{{ route('product.get.variant-card', ['slug' => $termTaxonomyVariant->slug]) }}"
            data-term-name="{{ get_meta_value($termTaxonomyVariant->productMetaInCardView, $termTaxonomy) }}"
                  data-taxonomy="{{ $termTaxonomy }}">
                {{ get_meta_value($termTaxonomyVariant->productMetaInCardView, $termTaxonomy) }}
            </span>
        @endforeach
    </div>
@endif
