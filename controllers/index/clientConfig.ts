import Lenis from '@studio-freight/lenis';

export default Object.freeze({
    default_product: {
        thumbnails: '/controllers/client/img/unknown.png',
        url: '/',
    },
    heading: {
        img: '/controllers/client/img/ip.png',
    },
    faqs: 'https://allinclicks.com/2026/01/04/linkbio-faq/',
});

export function smoothScrolling() {
    // smooth scroll
    const lenis = new Lenis();

    function ref(time: any) {
        lenis.raf(time);
        requestAnimationFrame(ref);
    }

    requestAnimationFrame(ref);
}
