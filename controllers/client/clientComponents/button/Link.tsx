import React from 'react'
import AppButton from './AppButton'

type Props = React.AnchorHTMLAttributes<HTMLAnchorElement> & {
    title?: string
}

const Link = ({title, ...props}: Props) => {
  return (
    <AppButton>
        <a {...props} className='flex items-center size-full p-[10px]'>
            {title}
        </a>
    </AppButton>
  )
}

export default Link
