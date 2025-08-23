/**
 * Function to get username from url. Eg: domain.com/willphan would return willphan
 * @returns string username
 */
export default function getUsername() {
    const path = window.location.pathname
    return path.split("/")[1]
}

/**
 * Function to get query string value
 * @param query query parameter to get. Eg: domain.com/willphan?template=10 would return 10 when query is template, and return null otherwise
 * @returns query string | null
 */
export function getParams(query: string) {
    // get full query string from url
    const queryString = window.location.search

    // parse query string
    const params = new URLSearchParams(queryString)

    return params.get(query)
}