import { useQuery } from '@tanstack/react-query';
import apiCompanyInfo, { CompanyInfo } from '../api/companyInfo';
import { BeatLoader } from 'react-spinners';
import useLanguageContext from '../../languages/context';

const Copyright = () => {
    const [language] = useLanguageContext();

    const { isPending } = useQuery<CompanyInfo | undefined>({
        queryKey: ['companyInfo'],
        queryFn: async () => await apiCompanyInfo.get(),
    });
    const copyright = `© ${new Date().getFullYear()} Allinclicks. All rights reserved.`;
    return (
        <div className="relative flex flex-col justify-center items-center w-full text-white">
            <p>{copyright}</p>
            {isPending ? (
                <BeatLoader />
            ) : (
                <div className="flex flex-row gap-3">
                    <a href={`/@privacy`} target="">
                        {language.footer.privacy}
                    </a>
                    <span> | </span>
                    <a href={`/@terms`} target="">
                        {language.footer.terms}
                    </a>
                    <span> | </span>
                    <a href={`/@pricing`} target="">
                        {language.footer.pricing}
                    </a>
                </div>
            )}
        </div>
    );
};

export default Copyright;
