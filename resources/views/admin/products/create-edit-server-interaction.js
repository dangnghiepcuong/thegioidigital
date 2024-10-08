import { fetchAsyncData } from '/resources/js/fetch';
import _get from 'lodash/get';

$(document).ready(async function () {
    // get parent product data & bind in form dropdown
    try {
        const response = await fetchAsyncData({
            url: '/admin/products/getParentProducts',
            cache: false,
            method: 'GET',
        })

        let oldValue = $('#parent_id').attr('value')

        response.data.forEach(item => {
            $('#parent_id').append(`<option value="${_get(item, 'id')}">${_get(item, 'title')}</option>`)
        });

        $('#parent_id').val(oldValue)
    } catch (error) {
        throw (error)
    }

    // catch on btn submit form create,update,replicate, perform a request
    $('#btn-submit-form-create-product').on('click', function () {
        $('input[name="description"]').val(window.productDescriptionEditor.getData())
        $('#form-create-product').submit()
    })
    $('#btn-submit-form-update-product').on('click', function () {
        $('input[name="description"]').val(window.productDescriptionEditor.getData())
        $('#form-update-product').submit()
    })
    $('#btn-submit-form-replicate-product').on('click', function () {
        $('#form-replicate-product').submit()
    })
})
