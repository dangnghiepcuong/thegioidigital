import _get from 'lodash/get'
import $ from 'jquery';
window.jQuery = $;
export default $;

export async function fetchAsyncData(options) {
    try {
        const response = await $.ajax(options)
        return response
    } catch (error) {
        console.log(error)
        throw (error)
    }
}

export function getMeta(metaList, key) {
    return metaList.filter(function (meta) {
        return _get(meta, 'key') === key
    })[0]
}