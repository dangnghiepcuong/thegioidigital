import { fetchAsyncData } from '/resources/js/fetch';
import _get from 'lodash/get';

import $ from 'jquery';
window.jQuery = $;
export default $;

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

    // bind data from form inputs to product card
    $('.demo-attribute').each(function () {
        let inputElement = $(this).find(':nth-child(2)')
        if (inputElement[1]) {
            bindAttribute(inputElement[1], $(`.layout-demo-product .card-product a`))
        } else {
            bindAttribute(inputElement, $(`.layout-demo-product .card-product a`))
        }
    })

    // bind data from hidden input to table term taxonomy
    let ids = $('input[name="term_taxonomy_ids"]').val().split('\n')
    ids.forEach(id => {
        let option = $('[name="term_taxonomy"]').find(`option[value="${id}"]`)
        bindAttributeToTableProductTermTaxonomy(option.val(), option.text(), $('.table-product-term-taxonomy'))
    })

    // catch on event add demo btn click, apply change to demo UI
    $('.demo-attribute').on('click', '.btn-add', function (event) {
        let inputElement = $(event.target).parent().find(':nth-child(2)')
        if (inputElement[1]) {
            bindAttribute(inputElement[1], $(`.layout-demo-product .card-product a`))
        } else {
            bindAttribute(inputElement, $(`.layout-demo-product .card-product a`))
        }
    })
    $('#btn-demo-change').click(function () {
        $('.demo-attribute').each(function () {
            let inputElement = $(this).find(':nth-child(2)')
            if (inputElement[1]) {
                bindAttribute(inputElement[1], $(`.layout-demo-product .card-product a`))
            } else {
                bindAttribute(inputElement, $(`.layout-demo-product .card-product a`))
            }
        })
    })

    $('.demo-attribute-to-table-product-meta').on('click', '.btn-add', function () {
        let metaKey = $(this).parent().find('#form-meta-key option:selected')
        let metaValue = $(this).parent().find('#form-meta-value')
        bindAttributeToTableProductMeta(metaKey, metaValue, $(`.table-product-meta tbody`))
        metaValue.val(``)
    })
    $('.demo-attribute-to-table-product-term-taxonomy').on('click', '.btn-add', function () {
        let parentElement = $(this).parent()
        let termTaxonomy = parentElement.find('[name="term_taxonomy"] option:selected')
        bindAttributeToTableProductTermTaxonomy(termTaxonomy.val(), termTaxonomy.text(), $('.table-product-term-taxonomy'))
    })

    // catch on btn remove click, apply change to demo UI
    $('.table-product-term-taxonomy').on('click', '.btn-remove', function () {
        let row = $(this).parent().parent()
        let termTaxonomyId = row.find('[name="term_taxonomy_id"]').val()
        let ids = $('[name="term_taxonomy_ids"]').val()
        ids = ids.replace(termTaxonomyId, '')
        $('[name="term_taxonomy_ids"]').val(ids)
        row.remove()
    })

    // catch on btn create product click, perform a request
    $('#create_product').on('click', function () {
        let metaKeys = $('.table-product-meta').find('tr td[class="meta-key"]')
        metaKeys.each(function (index, key) {
            console.log(key.text())
        })
    })
})

function bindAttribute(triggerElement, targetParentElements) {
    let stack = [
        'layout-top-tags',
        'holder-img',
        'layout-badge',
        'holder-product-name',
        'layout-compare-tags',
        'layout-attribute-options',
        'layout-regular-price',
        'layout-price',
        'layout-gift',
        'layout-rate',
    ]

    let layoutClass = $(triggerElement).attr('layout')
    let element = $(triggerElement).attr('element')
    let className = $(triggerElement).attr('class-name')
    let boundAttr = $(triggerElement).attr('bound-attr')
    let value = $(triggerElement).val()
    let checkSpaceStr = value.replace(/\s/g, '')
    if (!_get(checkSpaceStr, 'length')) {
        $(triggerElement).val(``)
        value = checkSpaceStr
    }
    let defaultValue = $(triggerElement).attr('default-value')
    let set = $(triggerElement).attr('set')

    if (layoutClass) {
        targetParentElements.each(function (j, parentElement) {
            let layoutStr = `<div class="${layoutClass}"></div>`
            let layoutIndex = stack.findIndex(item => {
                return item === layoutClass
            })

            let layoutElement = $(parentElement).find(`.${layoutClass}`)
            if (!_get(layoutElement, 'length')) {
                let flag = false
                for (let i = layoutIndex - 1; i >= 0; i--) {
                    let nearestAboveElement = $(parentElement).find(`.${stack[i]}`)
                    if (_get(nearestAboveElement, 'length')) {
                        flag = true
                        nearestAboveElement.after(layoutStr)
                        break
                    }
                }
                if (!flag) {
                    $(parentElement).prepend(layoutStr)
                }
            }
            layoutElement = $(parentElement).find(`.${layoutClass}`)

            if (!value) {
                switch (set) {
                    case 'append-once':
                        let find = layoutElement.find(`${element}[class="${className}"]`)
                        find.remove()
                        if (layoutElement.is(':empty')) {
                            layoutElement.remove()
                        }
                        break
                    default:
                        layoutElement.remove()
                }
                return
            }

            if (element === undefined) {
                layoutElement.attr(boundAttr, `${defaultValue} ${value}`)
                return
            }

            let elementStr = ``
            switch (element) {
                case 'img':
                    elementStr = `<${element} class="${className}" />`
                    break
                case 'span':
                default:
                    elementStr = `<${element} class="${className}"></${element}>`
            }

            switch (set) {
                case 'append-once':
                    let find = layoutElement.find(`${element}[class="${className}"]`)
                    if (_get(find, 'length')) {
                        find.remove()
                    }
                    layoutElement.append(elementStr)
                    break
                case 'line-separated':
                    layoutElement.html(``)
                    let lines = value.split('\n')
                    lines.forEach(line => {
                        if (!line) {
                            return
                        }
                        elementStr = `<${element} class="${className}">${line}</${element}>`
                        layoutElement.append(elementStr)
                    });
                    break
                default:
                    layoutElement.html(elementStr)
            }

            switch (boundAttr) {
                case 'text/html':
                    layoutElement.find(`${element}[class="${className}"]`).html(value)
                    break
                case 'multiple-text/html':
                    break
                default:
                    layoutElement.find(`${element}[class="${className}"]`).attr(boundAttr, value)
            }
        })
    }
}

function bindAttributeToTableProductMeta(metaKey, metaValue, targetTbodyElement) {
    let flagEmpty = false
    let checkSpaceStr = metaValue.val().replace(/\s/g, '')
    if (!_get(checkSpaceStr, 'length')) {
        metaValue.val(checkSpaceStr)
        flagEmpty = true
    }

    let metaKeyCell = targetTbodyElement.find(`tr td[class="meta-key"]:contains('${metaKey.val()}')`)
    if (_get(metaKeyCell, 'length')) {
        let trParent = metaKeyCell.parent()
        let metaValueCell = trParent.find(`td[class="meta-value"]`)
        if (flagEmpty) {
            metaValueCell.parent().remove()
        } else {
            let hiddenInput = trParent.find(`input[name="${metaKey.val()}"]`)
            hiddenInput.val(metaValue.val())
            metaValueCell.text(metaValue.val())
        }
        return
    }

    targetTbodyElement.append(`
            <tr>
                <td class="meta-key">${metaKey.val()}</td>
                <td class="meta-value">${metaValue.val()}</td>
                <input type="hidden" name="${metaKey.val()}" value="${metaValue.val()}">
            </tr>
            `)
}

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
                    <button type="button" class="btn btn-remove">X</button>
                    <input type="hidden" name="term_taxonomy_id" value="${termTaxonomyId}">
                </td>
            </tr>
            `)
}