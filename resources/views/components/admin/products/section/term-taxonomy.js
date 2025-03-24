import _get from 'lodash/get';
import $ from 'jquery';
window.jQuery = $;

$(document).ready(function () {
    // bind data from hidden input to table term taxonomy
    let ids = $('input[name="term_taxonomy_ids"]').val().split('\n')
    ids.forEach(id => {
        let option = $('[name="term_taxonomy"]').find(`option[value="${id}"]`)
        bindAttributeToTableProductTermTaxonomy(option.val(), option.text(), $('.table-product-term-taxonomy'))
    })

    // catch on event add demo btn click, apply change to demo UI
    $('.demo-attribute-to-table-product-term-taxonomy').on('click', '.btn-add', function () {
        let parentElement = $(this).parent()
        let termTaxonomy = parentElement.find('[name="term_taxonomy"] option:selected')
        bindAttributeToTableProductTermTaxonomy(termTaxonomy.val(), termTaxonomy.text(), $('.table-product-term-taxonomy'))
    })

    // catch on btn remove click, apply change to demo UI
    $('#table-product-term-taxonomy').on('click', '.btn-remove', function () {
        let row = $(this).parent().parent()
        let termTaxonomyId = row.find('[name="term_taxonomy_id"]').val()
        let ids = $('[name="term_taxonomy_ids"]').val()
        ids = ids.replace(termTaxonomyId, '')
        $('[name="term_taxonomy_ids"]').val(ids)
        row.remove()
    })
})

function bindAttributeToTableProductTermTaxonomy(termTaxonomyId, termTaxonomy, targetTbodyElement) {
    if (!termTaxonomyId) {
        return
    }

    let termTaxonomyCell = targetTbodyElement.
    find(`tr td[class="term-taxonomy"] input[name="term_taxonomy_id"][value="${termTaxonomyId}"]`)
    if (_get(termTaxonomyCell, 'length')) {
        return
    }

    let ids = $('input[name="term_taxonomy_ids"]').val()
    $('[name="term_taxonomy_ids"]').val(`${ids}\n${termTaxonomyId}`)

    targetTbodyElement.append(`
            <tr>
                <td class="term-taxonomy">
                    ${termTaxonomy}
                    <span class="icon material-symbols-outlined btn-remove">close</span>
                    <input type="hidden" name="term_taxonomy_id" value="${termTaxonomyId}">
                </td>
            </tr>
            `)
}
