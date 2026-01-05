import Language, { types } from './interface'
import en from './types/en'
import vn from './types/vn'

type L = {
    [K in (typeof types)[number]]: Language
}
const languages: L = {
    en,
    vn
}

export default languages