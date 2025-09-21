import Link from '../../../client/clientComponents/button/Link'
import config from '../../../client/config'

const TemplateButton = () => {
  return (
    <Link 
      title="Bio Template"
      href={config.routes.templateWUsername}
      style={{
        backgroundColor: "#5b35ff",
        color: "#fff"
      }}
    />
  )
}

export default TemplateButton
