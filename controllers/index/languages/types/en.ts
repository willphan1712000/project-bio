import Language from '../interface';

const en: Language = {
    type: 'en',
    name: 'English',
    navBar: {
        templates: 'Templates',
        privacy: 'Privacy',
        terms: 'Terms',
        signin: 'Sign in',
        signup: 'Sign up',
    },
    heading: {
        title: 'Level Up Your eBusiness Cards',
        des1: 'Create your profile and save it on an ',
        desSpan: 'eBusiness Cards',
        des2: ' Tap it on a phone to see how amazing your profile is',
        button1: 'Create Your Profile Now',
        button2: 'Explore Templates',
    },
    templates: {
        basic: {
            heading: 'Basic Templates',
            des: 'Just create your profile, buy a template of your choice and we will ship your card to you.',
        },
        pro: {
            heading: 'Pro Templates',
            des: 'Just create your profile, buy a pro template of your choice. You will have the pro template displayed on your profile + a card printed with the template shipped to you.',
        },
        diamond: {
            heading: '',
            des: '',
        },
    },
    cards: {
        basic: {
            heading: 'Basic eBusiness Cards',
            des: '',
        },
        professional: {
            heading: 'Professional eBusiness Cards',
            des: '',
        },
    },
    nfc: {
        title: 'Use NFC - Near Field Communication Technology',
        one: 'Cards use short-range wireless technology to communicate with compatible devices when brought close together.',
        two: 'These cards can store and transmit small amounts of data, such as contact info, website links, or payment credentials.',
        three: 'NFC cards require no battery and are often used for digital business cards, access control, or contactless payments.',
    },
    footer: {
        contactUs: 'Contact Us',
        faq: 'Frequently Asked Questions',
        privacy: 'Privacy Policy',
        terms: 'Terms of Use',
        pricing: 'Pricing Policy',
        templates: 'Templates',
        signin: 'Sign in',
        signup: 'Sign up',
    },
};

export default en;
