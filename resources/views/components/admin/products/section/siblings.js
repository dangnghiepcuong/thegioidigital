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

    // catch on checked applying data input to selected variants/siblings
    $('#layout-siblings .layout-applied-data-checkbox .applied-data-field').on('change', 'input[name*="siblings_"]', function () {
        if ($(this).is(':checked')) {
            let separator = $('#siblings_applied_data').val() ? `,` : ``
            $('#siblings_applied_data').val(`${$('#siblings_applied_data').val()}${separator}${$(this).val()}`)
            return
        }
        let value = $('#siblings_applied_data').val()
        value = value.replace(`,${$(this).val()}`, ``)
        value = value.replace(`${$(this).val()}`, ``)
        $('#siblings_applied_data').val(value)
    })
})
