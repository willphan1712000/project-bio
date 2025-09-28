export default function errorFormat(errorCode?: string, errorMessage?: string) {
    return `${errorCode ?? 'Error'} : ${errorMessage ?? 'Unknown problem occurred'}`
}