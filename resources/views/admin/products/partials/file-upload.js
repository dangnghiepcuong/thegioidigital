import { fetchAsyncData } from '/resources/js/fetch'
import _get from 'lodash/get'

$(document).ready(function () {
    $('#input-file-upload').change(async function () {
        let form = $('#form-upload-image-for-product-slider')
        let formData = new FormData(form[0])

        const { data } = await fetchAsyncData({
            url: '/admin/products/files/slider-images',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('#csrf-token').val(),
            },
            data: formData,
            processData: false,
            contentType: false,
        })

        let html = ``
        data.forEach(media => {
            html += `<a href="${_get(media, 'originalUrl')}" target="_blank" class="outer-slider-image layout-checkbox">
                        <input type="checkbox" value="${_get(media, 'uuid')}" name="slider_images[]">
                        <img src="${_get(media, 'previewUrl')}" alt="${_get(media, 'name')}" target="_blank" >
                    </a>`
        });

        $('#layout-img-thumbs').html(html)
    })

    $('#btn-select-all-slider-images').on('click', function () {
        $('#layout-img-thumbs [name="slider_images[]"]').prop('checked', true)
    })

    $('#btn-deselect-all-slider-images').on('click', function () {
        $('#layout-img-thumbs [name="slider_images[]"]').prop('checked', false)
    })

    $('#btn-delete-slider-image').on('click', async function () {
        let sliderImages = []
        $('[name="slider_images[]"]').each(function () {
            if ($(this).prop('checked')) {
                sliderImages.push($(this).val())
            }
        })

        let productId = $('[name="product_id"]').val()

        await fetchAsyncData({
            url: '/admin/products/files/slider-images',
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('#csrf-token').val(),
            },
            data: { slider_images: sliderImages, product_id: productId },
            cache: false,
        })

        const { data } = await fetchAsyncData({
            url: '/admin/products/files/slider-images',
            method: 'GET',
            data: { product_id: productId }
        })
        console.log(data)
        let html = ``
        data.forEach(media => {
            html += `<a href="${_get(media, 'originalUrl')}" target="_blank" class="outer-slider-image layout-checkbox">
                        <input type="checkbox" value="${_get(media, 'uuid')}" name="slider_images[]">
                        <img src="${_get(media, 'previewUrl')}" alt="${_get(media, 'name')}" target="_blank" >
                    </a>`
        });
        $('#layout-img-thumbs').html(html)
    })
})
