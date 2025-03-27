<!-- The whole future lies in uncertainty: live immediately. - Seneca -->
@use('App\Enums\ModelMetaKey')

<div class="section" for="layout-term-taxonomy">
    {{ __('term.term_taxonomy') }}
    <span class="icon material-symbols-outlined">add</span>
</div>
<div class="section-content layout-term-taxonomy" id="layout-term-taxonomy">
    <div class="form-item demo-attribute-to-table-product-term-taxonomy">
        <label for="form-term-taxonomy">{{ __('term.term_taxonomy') }}</label>
        <select name="term_taxonomy" id="form-term-taxonomy">
            <option value=""></option>
            @foreach ($termTaxonomies as $termTaxonomy)
                <option value="{{ $termTaxonomy->id }}">
                    {{ $termTaxonomy->term->name . ' (' . __("product_meta.$termTaxonomy->taxonomy") . ')' }}</option>
            @endforeach
        </select>
        <span class="icon material-symbols-outlined btn-add">add</span>
    </div>
    <table class="table-product-term-taxonomy" id="table-product-term-taxonomy">
        <thead>
        <tr>
            <th>{{ __('term.term_taxonomy') }}</th>
        </tr>
        </thead>
        <tbody>
        @isset($productTermTaxonomies)
            @foreach ($productTermTaxonomies as $productTermTaxonomy)
                <tr>
                    <td class="term-taxonomy">
                        {{ $productTermTaxonomy->term->name . ' (' . __("product_meta.$productTermTaxonomy->taxonomy") . ')' }}
                        <span class="icon material-symbols-outlined btn-remove">close</span>
                        <input type="hidden" name="term_taxonomy_id" value="{{ $productTermTaxonomy->id }}">
                    </td>
                </tr>
            @endforeach
        @endisset
        </tbody>
    </table>
    <input type="hidden" name="term_taxonomy_ids"
           value="{{ $productTermTaxonomies ? implode("\n", $productTermTaxonomies->pluck('id')->toArray()) : null }}"/>
</div>
@pushonce('scripts')
    @vite($viewsDir . '/components/admin/products/section/term-taxonomy.js')
@endpushonce
