import useLanguageContext from "../../languages/context"
import Language from "../buttons/Language"
import Signin from "../buttons/Signin"
import Signup from "../buttons/Signup"

const Button = () => {
  const [language, ] = useLanguageContext()
  return (
    <>
        <Language content="Change language"/>
        <Signin content={language.navBar.signin} />
        <Signup content={language.navBar.signup} />
    </>
  )
}

export default Button
