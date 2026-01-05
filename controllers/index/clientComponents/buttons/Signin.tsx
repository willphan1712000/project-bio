// import { Button } from '@willphan1712000/w'
import { ComponentProps } from 'react'
import { Button } from '@willphan1712000/frontend'

interface Props {
    content: string
}

const Signin = ({...otherProps}: Props) => {
  return (
    <Button {...otherProps} onClick={() => window.location.href = '/@signin'} buttonType='solid'/>
  )
}

export default Signin
