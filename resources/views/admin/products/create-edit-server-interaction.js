import { fetchAsyncData } from "/resources/js/fetch";
import _get from 'lodash/get';
import $ from 'jquery';
window.jQuery = $;

$(document).ready(async function () {
    $(".btn-demo-change").click(function () {
        getProductCard()
    });

    // catch on btn submit form create,update,replicate, perform a request
    $("#btn-submit-form-create-product").on("click", function () {
        $('input[name="description"]').val(
            window.productDescriptionEditor.getData()
        );
        $("#form-create-update-product").submit();
    });
    $("#btn-submit-form-update-product").on("click", function () {
        $('input[name="description"]').val(
            window.productDescriptionEditor.getData()
        );
        $("#form-create-update-product").submit();
    });
    $("#btn-submit-form-replicate-product").on("click", function () {
        $("#form-replicate-product").submit();
    });
});

async function getProductCard() {
    let form = $("#form-create-update-product");
    try {
        const { data } = await fetchAsyncData({
            url: "/admin/products/card-view-by-data",
            cache: false,
            method: "GET",
            data: form.serialize()
        });
        $(".layout-demo-product .card-product").replaceWith(data);
    } catch (exception) {
        let elLayoutErrors = $(".layout-errors");
        switch (_get(exception, 'status')) {
            case 403:
            case 404:
            case 422:
                elLayoutErrors.html(`<span class="error">${_get(exception.responseJSON, 'message')}</span><br>`);
                break
        }
    }
}
