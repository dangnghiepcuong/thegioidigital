import $ from 'jquery';
window.jQuery = $;

$(document).ready(function () {
    // catch on select/deselect all variants/siblings
    $('#btn-select-all-siblings').on('click', function () {
        $('#layout-list-siblings .checkbox-sibling').prop('checked', true)
    })
    $('#btn-deselect-all-siblings').on('click', function () {
        $('#layout-list-siblings .checkbox-sibling').prop('checked', false)
    })
})
