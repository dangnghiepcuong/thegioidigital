$(document).ready(function () {
    $('.section').click(function () {
        $(this).toggleClass('open-section')
        if ($(this).hasClass('open-section')) {
            $(this).find('span.icon').text('remove')
        } else {
            $(this).find('span.icon').text('add')
        }

        let sectionName = $(this).attr('for')

        if ($(`#${sectionName}`).css('max-height') === '0px' || $(`#${sectionName}`).css('max-height') === '0') {
            $(`#${sectionName}`).css('max-height', 600)
        } else {
            $(`#${sectionName}`).css('max-height', 0)
        }
    })
})
