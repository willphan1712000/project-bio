/**
 * Language interface for main page
 */
export default interface Language {
    type: | 'en' | 'vn' | 'other'
    navBar: {
        templates: string,
        terms: string,
        privacy: string,
        signin: string,
        signup: string
    },
    heading: {
        title: string,
        des1: string,
        desSpan: string,
        des2: string,
        button1: string,
        button2: string
    },
    nfc: {
        title: string,
        one: string,
        two: string,
        three: string
    },
    cards: {
        basic: {
            heading: string,
            des: string
        },
        professional: {
            heading: string,
            des: string
        }
    },
    templates: {
        basic: {
            heading: string,
            des: string
        },
        pro: {
            heading: string,
            des: string
        },
        diamond: {
            heading: string,
            des: string
        }
    }
}