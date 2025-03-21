import $ from 'jquery';
window.jQuery = $;
export default $;

import { fetchAsyncData } from '/resources/js/fetch';

$(document).ready(function () {
    $('.layout-list-product').on('click', '.card-product .layout-attribute-options', async function (event) {
        let url = $(event.target).attr('data-link')
        let slug = $(event.target).attr('data-slug')
        let termName = $(event.target).attr('data-term-name')
        let taxonomy = $(event.target).attr('data-taxonomy')
        if (!slug || !termName || !taxonomy) {
            window.location.href = $(this).attr('href');
            return
        }

        if ($(event.target).hasClass('selected-option')) {
            return
        }

        try {
            const html = await fetchAsyncData({
                url: url,
                cache: false,
                method: 'GET',
                data: { term_name: termName, taxonomy: taxonomy }
            })

            $(this).closest('.card-product').replaceWith(html)
        } catch (error) {
            console.log(error)
            throw (error)
        }
    });
})
