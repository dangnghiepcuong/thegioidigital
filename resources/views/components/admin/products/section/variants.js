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

    $('#layout-variants .layout-applied-data-checkbox .applied-data-field').on('change', 'input[name*="variants_"]', function () {
        if ($(this).is(':checked')) {
            let separator = $('#variants_applied_data').val() ? `,` : ``
            $('#variants_applied_data').val(`${$('#variants_applied_data').val()}${separator}${$(this).val()}`)
            return
        }

        let value = $('#variants_applied_data').val()
        value = value.replace(`,${$(this).val()}`, ``)
        value = value.replace(`${$(this).val()}`, ``)
        $('#variants_applied_data').val(value)
    })
})
