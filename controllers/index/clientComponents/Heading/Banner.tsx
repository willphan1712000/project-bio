import clientConfig from '../../clientConfig';
import AppImage from '../../../client/clientComponents/AppImage';
import Signin from '../buttons/Signin';
import Template from '../Template';
import useLanguageContext from '../../languages/context';

const Banner = () => {
    const [language] = useLanguageContext();

    return (
        <div className="lg:p-[100px] p-[40px] flex flex-row justify-center max-w-[1500px]">
            <div className="flex lg:flex-row flex-col content-center w-full justify-between items-center">
                <div className="flex flex-col lg:w-[70%] w-full">
                    <h1 className="text-[50px] font-bold">
                        {language.heading.title}
                    </h1>
                    <p className="text-[25px] font-bold">
                        {language.heading.des1}
                        <span className="text-[25px] font-bold py-2 px-3 text-white bg-[--primary] rounded-full whitespace-nowrap overflow-hidden text-ellipsis">
                            {language.heading.desSpan}
                        </span>
                        {language.heading.des2}
                    </p>
                    <div className="flex lg:flex-row flex-col gap-5 pt-10 items-center">
                        <div className="w-fit">
                            <Signin content={language.heading.button1} />
                        </div>
                        <div className="w-fit">
                            <Template content={language.heading.button2} />
                        </div>
                    </div>
                </div>
                <div className="w-[20%] rounded-[40px] overflow-hidden lg:flex hidden max-w-[400px]">
                    <AppImage
                        src={clientConfig.heading.img}
                        className="size-full"
                    />
                </div>
            </div>
        </div>
    );
};

export default Banner;
