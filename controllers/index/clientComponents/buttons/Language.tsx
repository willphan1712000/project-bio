import { Button } from '@willphan1712000/frontend'
import useLanguageContext from '../../languages/context'
import languages from '../../languages'

interface Props {
    content: string
}

const Language = ({...otherProps}: Props) => {
  const [language ,setLanguage] = useLanguageContext()

  return (
    <Button {...otherProps} onClick={() => {
      if (language.type === 'en') {
        localStorage.setItem('language', 'vn')
        setLanguage(languages.vn)
      } else {
        localStorage.setItem('language', 'en')
        setLanguage(languages.en)
      }
    }} buttonType="solid" 
    className='text-[12px]'
    />
  )
}

export default Language
