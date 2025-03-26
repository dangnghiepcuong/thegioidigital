<!-- People find pleasure in different ways. I find it in keeping my mind clear. - Marcus Aurelius -->
<div class="section" for="layout-upload-image">
    {{ __('product.upload_image') }}
    <span class="icon material-symbols-outlined">add</span>
</div>
<div class="section-content layout-upload-image" id="layout-upload-image">
    <form action="{{ route('admin.products.slider.image') }}" method="POST" id="form-upload-image-for-product-slider">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <div class="Neon Neon-theme-dragdropbox">
            <input class="input-file-upload" id="input-file-upload" type="file" name="upload[]" multiple>
            <input type="hidden" id="product_id" name="product_id" value="{{ $productId }}" />
            <div class="Neon-input-dragDrop">
                <div class="Neon-input-inner">
                    <div class="Neon-input-icon">
                        <i class="fa fa-file-image-o"></i>
                    </div>
                    <div class="Neon-input-text">
                        <h3>Drag&amp;Drop files here</h3>
                        <span style="display:inline-block; margin: 15px 0">or</span>
                    </div>
                    <a class="Neon-input-choose-btn blue">Browse Files</a>
                </div>
            </div>
        </div>
    </form>

    <h3>Uploaded Images</h3>
    <div class="layout-btn-line">
        <div class="item-btn" id="btn-select-all-slider-images">
            {{ __('button.select_all') }}
            <span class="icon material-symbols-outlined">check_box</span>
        </div>
        <div class="item-btn" id="btn-deselect-all-slider-images">
            {{ __('button.deselect_all') }}
            <span class="icon material-symbols-outlined">check_box_outline_blank</span>
        </div>
    </div>
    <div class="layout-btn-line">
        <div class="item-btn" id="btn-delete-slider-image"
             onclick="return confirm('Are you sure you want to delete selected images?')">
            {{ __('button.delete') }}
            <span class="icon material-symbols-outlined">delete</span>
        </div>
    </div>

    <div id="layout-img-thumbs" class="layout-img-thumbs">
        @foreach ($sliderImages as $media)
            <a href="{{ get_property($media, 'originalUrl') }}" target="_blank"
               class="outer-slider-image layout-checkbox">
                <input type="checkbox" value="{{ get_property($media, 'uuid') }}" name="slider_images[]">
                <img src="{{ get_property($media, 'previewUrl') }}" alt="{{ get_property($media, 'name') }}"
                     class="slider-images-preview">
            </a>
        @endforeach
    </div>
</div>
@pushonce('scripts')
    @vite($viewsDir . '/components/admin/products/section/file-upload.js')
@endpushonce
