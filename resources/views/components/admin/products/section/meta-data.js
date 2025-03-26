import _get from 'lodash/get';
import $ from 'jquery';
window.jQuery = $;

$(document).ready(function () {
    // catch on event add demo btn click, apply change to demo UI
    $('.demo-attribute-to-table-product-meta').on('click', '.btn-add', function () {
        let metaKey = $(this).parent().find('#form-meta-key option:selected')
        let metaValue = $(this).parent().find('#form-meta-value')
        bindAttributeToTableProductMeta(metaKey, metaValue, $(`#table-product-meta tbody`))
        metaValue.val(``)
    })

    // catch on btn remove click, apply change to demo UI
    $('#table-product-meta').on('click', '.btn-remove', function () {
        let row = $(this).parent().parent()
        row.remove()
    })

})

function bindAttributeToTableProductMeta(metaKey, metaValue, targetTbodyElement) {
    let checkSpaceStr = metaValue.val().replace(/\s/g, '')
    if (!_get(checkSpaceStr, 'length')) {
        return
    }

    let metaKeyCell = targetTbodyElement.find(`tr td[class="meta-key"]:contains('${metaKey.val()}')`)
    if (_get(metaKeyCell, 'length')) {
        let trParent = metaKeyCell.parent()
        let metaValueCell = trParent.find(`td[class="meta-value"]`)
        let hiddenInput = trParent.find(`input[name="${metaKey.val()}"]`)
        hiddenInput.val(metaValue.val())
        metaValueCell.text(metaValue.val())
        return
    }

    targetTbodyElement.append(`
            <tr>
                <td class="meta-key">${metaKey.val()}</td>
                <td class="meta-value">
                    ${metaValue.val()}
                    <span class="icon material-symbols-outlined btn-remove">close</span>
                </td>
                <input type="hidden" name="${metaKey.val()}" value="${metaValue.val()}">
            </tr>
            `)
}
