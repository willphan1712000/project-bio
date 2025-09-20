import config from '../../../client/config'
import AppButton from '../AppButton'

const CreateAnother = () => {
  return (
    <AppButton>
        <a href={config.routes.signup}>Create another account</a>
    </AppButton>
  )
}

export default CreateAnother
