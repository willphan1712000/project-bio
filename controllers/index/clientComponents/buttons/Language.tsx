import { Button } from '@willphan1712000/w'
import { ComponentProps } from 'react'
import useLanguageContext from '../../languages/context'
import * as languages from '../../languages'

interface Props extends ComponentProps<typeof Button> {
    title?: string
}

const Language = ({...otherProps}: Props) => {
  const [language ,setLanguage] = useLanguageContext()

  return (
    <Button {...otherProps} onClick={() => {
      if (language.type === 'en') {
        setLanguage(languages.vn)
      } else {
        setLanguage(languages.en)
      }
    }} type="solid" />
  )
}

export default Language
