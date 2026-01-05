/**
 * Type of language depending on how many countries are supported
 */
export const types = ['en', 'vn'] as const;

/**
 * Language interface for main page
 */
export default interface Language {
    type: (typeof types)[number];
    name: string;
    navBar: {
        templates: string;
        terms: string;
        privacy: string;
        signin: string;
        signup: string;
    };
    heading: {
        title: string;
        des1: string;
        desSpan: string;
        des2: string;
        button1: string;
        button2: string;
    };
    nfc: {
        title: string;
        one: string;
        two: string;
        three: string;
    };
    cards: {
        basic: {
            heading: string;
            des: string;
        };
        professional: {
            heading: string;
            des: string;
        };
    };
    templates: {
        basic: {
            heading: string;
            des: string;
        };
        pro: {
            heading: string;
            des: string;
        };
        diamond: {
            heading: string;
            des: string;
        };
    };
    footer: {
        contactUs: string;
        faq: string;
        privacy: string;
        terms: string;
        pricing: string;
        templates: string;
        signin: string;
        signup: string;
    };
}
