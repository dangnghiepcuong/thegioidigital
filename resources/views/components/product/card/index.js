import $ from 'jquery';
window.jQuery = $;
export default $;

import { fetchAsyncData, getMeta } from '/resources/js/fetch';
import _get from 'lodash/get'

$(document).ready(function () {
    $('.layout-list-product').on('click', '.card-product a', async function (event) {
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
                url: `/dtdd/product-variant/${slug}`,
                cache: false,
                method: 'GET',
                data: { term_name: termName, taxonomy: taxonomy }
            })

            $(this).parent().replaceWith(html)
        } catch (error) {
            console.log(error)
            throw (error)
        }
    });
})
