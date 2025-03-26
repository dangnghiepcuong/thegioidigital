import $ from 'jquery';
window.jQuery = $;

$(document).ready(function () {
    let elBadgeBgStyle = $('[name="product_attr_badge_background_style"]')
    initBadgeTemplateFields(elBadgeBgStyle.val())

    elBadgeBgStyle.on('change', function () {
        let bgStyle = $(this).val()
        initBadgeTemplateFields(bgStyle)
    })
})

function initBadgeTemplateFields(bgStyle) {
    let elBadgeBgColor1 = $('[name="product_attr_badge_background_color_1"]')
    let elBadgeBgColor2 = $('[name="product_attr_badge_background_color_2"]')
    let elBadgeBgColorReverse = $('[name="product_attr_badge_background_color_reverse"]')
    let elBadgeBgUrl = $('[name="product_attr_badge_background_url"]')
    let elBadgeIconUrl = $('[name="product_attr_badge_icon_url"]')
    let elBadgeText = $('[name="product_attr_badge_text"]')
    let elBadgeTextColor = $('[name="product_attr_badge_text_color"]')

    switch (bgStyle) {
        case 'linear_to_right':
        case 'linear_to_left':
        case 'linear_to_top':
        case 'linear_to_bottom':
        case 'radial':
            elBadgeBgColor1.closest('.form-item').removeClass('d-none')
            elBadgeBgColor2.closest('.form-item').removeClass('d-none')
            elBadgeBgColorReverse.closest('.form-item').removeClass('d-none')
            elBadgeIconUrl.closest('.form-item').removeClass('d-none')
            elBadgeText.closest('.form-item').removeClass('d-none')
            elBadgeTextColor.closest('.form-item').removeClass('d-none')

            elBadgeBgUrl.closest('.form-item').addClass('d-none').find('input').val('')
            break
        case 'solid':
            elBadgeBgColor1.closest('.form-item').removeClass('d-none')
            elBadgeIconUrl.closest('.form-item').removeClass('d-none')
            elBadgeText.closest('.form-item').removeClass('d-none')
            elBadgeTextColor.closest('.form-item').removeClass('d-none')

            elBadgeBgColor2.closest('.form-item').addClass('d-none').find('input').val('')
            elBadgeBgColorReverse.closest('.form-item').addClass('d-none').find('input').prop('checked', false)
            elBadgeBgUrl.closest('.form-item').addClass('d-none').find('input').val('')
            break
        case 'url':
            elBadgeBgColor1.closest('.form-item').addClass('d-none')
            elBadgeBgColor2.closest('.form-item').addClass('d-none')
            elBadgeBgColorReverse.closest('.form-item').addClass('d-none')

            elBadgeBgUrl.closest('.form-item').removeClass('d-none')
            elBadgeIconUrl.closest('.form-item').removeClass('d-none')
            elBadgeText.closest('.form-item').removeClass('d-none')
            elBadgeTextColor.closest('.form-item').removeClass('d-none')
            break
        default:
            elBadgeBgColor1.closest('.form-item').addClass('d-none').find('input').val('')
            elBadgeBgColor2.closest('.form-item').addClass('d-none').find('input').val('')
            elBadgeBgColorReverse.closest('.form-item').addClass('d-none').find('input').prop('checked', false)
            elBadgeBgUrl.closest('.form-item').addClass('d-none').find('input').val('')
            elBadgeIconUrl.closest('.form-item').addClass('d-none').find('input').val('')
            elBadgeText.closest('.form-item').addClass('d-none').find('input').val('')
            elBadgeTextColor.closest('.form-item').addClass('d-none').find('input').val('')
            break;
    }
}
