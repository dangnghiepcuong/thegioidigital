import { fetchAsyncData } from '/resources/js/fetch';
import $ from 'jquery';
window.jQuery = $;
export default $;

window.getMoreUserPermissions = async function (element, userId, page = null) {
    let nextPage = $(element).find('input[name="next_page"]')
    let lastPage = $(element).find('input[name="last_page"]')
    let total = $(element).find('input[name="total"]')

    page = page ?? nextPage.val()

    try {
        const html = await fetchAsyncData({
            url: '/admin/permissions/getUserPermissionItems',
            cache: false,
            method: 'GET',
            data: { user_id: parseInt(userId), page: parseInt(page) }
        })

        $('#list-user-permissions #btn-see-more-user-permissions').before(html)

        nextPage.val(parseInt(nextPage.val()) + 1)

        if (parseInt(nextPage.val()) > parseInt(lastPage.val())) {
            $('#btn-see-more-user-permissions').remove()
        }

        $('#btn-see-more-user-permissions .btn-text').text(`Xem thêm ${total.val() - $('#list-user-permissions .item').length} quyền`)
    } catch (error) {
        console.log(error)
        throw (error)
    }
}
