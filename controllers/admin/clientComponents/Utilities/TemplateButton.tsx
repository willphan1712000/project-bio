import { Button } from '@radix-ui/themes'
import React from 'react'
import config from '../../../client/config'

const TemplateButton = () => {
  return (
    <Button>
        <a href={config.routes.templateWUsername + 'nha'}>Bio Template</a>
    </Button>
  )
}

export default TemplateButton
