import _get from 'lodash/get';

import $ from 'jquery';
window.jQuery = $;
export default $;

$(document).ready(function () {
    // set max height for layout-editing-sections depends on screen height
    let height = screen.height;
    $('.layout-editing-sections').css('max-height', height * 0.83)

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

    // Open & Closed sections
    $('.section').click(function () {
        let isOpen = $(this).hasClass('open-section')
        $('.section').removeClass('open-section')
        $('.section').find('span.icon').text('add')
        $('.section-content').css('max-height', 0)
        $('.section-content').css('border-bottom', 'unset')

        if (isOpen) {
            $(this).removeClass('open-section')
            $(this).find('span.icon').text('add')
        } else {
            $(this).addClass('open-section')
            $(this).find('span.icon').text('remove')
        }

        let sectionName = $(this).attr('for')

        if ($(`#${sectionName}`).css('max-height') === '0px' || $(`#${sectionName}`).css('max-height') === '0') {
            let sectionContentHeight = $(`#${sectionName}`).prop('scrollHeight') + 1 < 600 ? 600 : $(`#${sectionName}`).prop('scrollHeight') + 1
            $(`#${sectionName}`).css('max-height', sectionContentHeight)
            $(`#${sectionName}`).css('border-bottom', '1px solid #999')
        } else {
            $(`#${sectionName}`).css('max-height', 0)
            $(`#${sectionName}`).css('border-bottom', 'unset')
        }
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
    $('.table-product-meta').on('click', '.btn-remove', function () {
        let row = $(this).parent().parent()
        row.remove()
    })
    $('.table-product-term-taxonomy').on('click', '.btn-remove', function () {
        let row = $(this).parent().parent()
        let termTaxonomyId = row.find('[name="term_taxonomy_id"]').val()
        let ids = $('[name="term_taxonomy_ids"]').val()
        ids = ids.replace(termTaxonomyId, '')
        $('[name="term_taxonomy_ids"]').val(ids)
        row.remove()
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
