import useLanguageContext from '../../languages/context';
import Language from '../buttons/Language';
import Signin from '../buttons/Signin';
import Signup from '../buttons/Signup';

const Button = () => {
    const [language] = useLanguageContext();
    return (
        <>
            <div className="w-fit">
                <Language content={`Current language: ${language.name}`} />
            </div>
            <div className="flex flex-row gap-2 justify-center">
                <Signin content={language.navBar.signin} />
                <Signup content={language.navBar.signup} />
            </div>
        </>
    );
};

export default Button;
