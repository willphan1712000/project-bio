import useLanguageContext from '../../languages/context';

const Link = () => {
    const [language] = useLanguageContext();
    return (
        <>
            <a
                href="/@template"
                className="hover:bg-[#f5f5f7] p-[10px] rounded-[10px]"
            >
                {language.navBar.templates}
            </a>
            <a
                href={`/@terms`}
                className="hover:bg-[#f5f5f7] p-[10px] rounded-[10px]"
            >
                {language.navBar.terms}
            </a>
            <a
                href={`/@privacy`}
                className="hover:bg-[#f5f5f7] p-[10px] rounded-[10px]"
            >
                {language.navBar.privacy}
            </a>
        </>
    );
};

export default Link;
