import $ from 'jquery';
window.jQuery = $;

$(document).ready(function () {
    $('#btn-submit-form-create-attribute').on('click', function () {
        console.log('click')
        $('#form-create-product-attribute').submit();
    })
})
