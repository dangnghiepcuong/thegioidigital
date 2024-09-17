$(document).ready(function () {
    let height = screen.height;
    $('.layout-editing-sections').css('max-height', height * 0.83)

    $('.section').click(function () {
        let isOpen = $(this).hasClass('open-section')
        $('.section').removeClass('open-section')
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
            console.log(sectionContentHeight)
            $(`#${sectionName}`).css('max-height', sectionContentHeight)
            $(`#${sectionName}`).css('border-bottom', '1px solid #999')
        } else {
            $(`#${sectionName}`).css('max-height', 0)
            $(`#${sectionName}`).css('border-bottom', 'unset')
        }
    })
})
