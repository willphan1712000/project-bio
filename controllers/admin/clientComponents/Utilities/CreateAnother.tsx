import Link from '../../../client/clientComponents/button/Link'
import config from '../../../client/config'

const CreateAnother = () => {
  return (
    <Link
      title='Create another account'
      href={config.routes.signup}
    />
  )
}

export default CreateAnother
