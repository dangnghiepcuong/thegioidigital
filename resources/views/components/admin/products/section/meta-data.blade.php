<!-- When there is no desire, all things are at peace. - Laozi -->
@use('App\Enums\ModelMetaKey')

<div class="section" for="layout-meta-data">
    {{ __('product_meta.meta_data') }}
    <span class="icon material-symbols-outlined">add</span>
</div>
<div class="section-content layout-meta-data" id="layout-meta-data">
    <div class="form-item demo-attribute-to-table-product-meta">
        <label for="form-meta-key">{{ __('product_meta.meta_key') }}</label>
        <select id="form-meta-key">
            @foreach (ModelMetaKey::notShownInCardCases() as $metaKey)
                @if (str_starts_with($metaKey, 'product_attr_'))
                    <option value="{{ $metaKey }}">{{ __("product_meta.$metaKey") }}</option>
                @endif
            @endforeach
        </select>
        <label for="form-meta-value">{{ __('product_meta.meta_value') }}</label>
        <input type="text" id="form-meta-value">
        <span class="icon material-symbols-outlined btn-add">add</span>
    </div>
    <table id="table-product-meta">
        <thead>
        <tr>
            <th>{{ __('product_meta.meta_key') }}</th>
            <th>{{ __('product_meta.meta_value') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach (ModelMetaKey::notShownInCardCases() as $metaKey)
            @if (old($metaKey) && in_array($metaKey, ModelMetaKey::notShownInCardCases()))
                <tr>
                    <td class="meta-key">{{ __("product_meta.$metaKey") }}</td>
                    <td class="meta-value">
                        {{ old($metaKey) }}
                        <span class="icon material-symbols-outlined btn-remove">close</span>
                    </td>
                    <input type="hidden" name="{{ $metaKey }}" value="{{ old($metaKey) }}">
                </tr>
            @endif
        @endforeach
        @isset($productMeta)
            @foreach ($productMeta as $meta)
                @if (!old($metaKey) && in_array($meta->key, ModelMetaKey::notShownInCardCases()))
                    <tr>
                        <td class="meta-key">{{ __("product_meta.$meta->key") }}</td>
                        <td class="meta-value">
                            {{ $meta->value }}
                            <span class="icon material-symbols-outlined btn-remove">close</span>
                        </td>
                        <input type="hidden" name="{{ $meta->key }}" value="{{ $meta->value }}">
                    </tr>
                @endif
            @endforeach
        @endisset
        </tbody>
    </table>
</div>
@pushonce('scripts')
    @vite($viewsDir . '/components/admin/products/section/meta-data.js')
@endpushonce
