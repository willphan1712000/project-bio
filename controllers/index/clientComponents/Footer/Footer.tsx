import { Button } from '@willphan1712000/w';
import Logo from '../../../client/clientComponents/Logo';
import Info from './Info';
import Social from './Social';
import Copyright from './Copyright';
import useLanguageContext from '../../languages/context';
import Signin from '../buttons/Signin';
import Signup from '../buttons/Signup';
import Template from '../buttons/Template';

const Footer = () => {
    const [language] = useLanguageContext();

    return (
        <div className="bg-[#111113] p-[30px] w-full flex flex-row justify-center rounded-t-[30px] z-[1]">
            <div className=" max-w-[1000px]">
                <div className="flex flex-col lg:flex-row gap-10 justify-center items-center lg:items-start">
                    <div className="flex-1 w-[50%] max-w-[300px]">
                        <Logo />
                    </div>
                    <Info />
                    <div className="flex flex-[2] flex-col items-center gap-5">
                        <Template content={language.footer.templates} />
                        <div className="flex flex-row gap-4">
                            <Signin content={language.footer.signin} />
                            <Signup content={language.footer.signup} />
                        </div>
                    </div>
                </div>
                <div className="border-b-[1px] border-b-white p-10"></div>
                <Social />
                <Copyright />
            </div>
        </div>
    );
};

export default Footer;
