export async function fetchAsyncData(options) {
    try {
        const response = await $.ajax(options)
        return response
    } catch (error) {
        console.log(error)
        throw(error)
    }
}
