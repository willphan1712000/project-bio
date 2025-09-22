import React from 'react'
import AppButton from './AppButton'

type Props = React.AnchorHTMLAttributes<HTMLAnchorElement> & {
    title?: string,
    style?: React.CSSProperties
}

const Link = ({title, style, ...props}: Props) => {
  return (
    <AppButton>
        <a {...props} style={{
          display: 'flex',
          justifyContent: 'center',
          alignItems: 'center',
          width: '100%',
          height: '100%',
          padding: '10px',
          ...style
        }}>
            {title}
        </a>
    </AppButton>
  )
}

export default Link
