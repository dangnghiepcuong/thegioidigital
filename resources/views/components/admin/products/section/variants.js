import $ from 'jquery';
window.jQuery = $;

$(document).ready(function () {
    // catch on select/deselect all variants/siblings
    $('#btn-select-all-variants').on('click', function () {
        $('#layout-list-variants .checkbox-variant').prop('checked', true)
    })
    $('#btn-deselect-all-variants').on('click', function () {
        $('#layout-list-variants .checkbox-variant').prop('checked', false)
    })
})
