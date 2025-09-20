
import AppAlertDialog from '../../../client/clientComponents/AppAlertDialog'
import CreateAnother from './CreateAnother'
import Signout from './Signout'
import TemplateButton from './TemplateButton'

const Utilities = () => {
  return (
    <div className='flex flex-row items-center gap-3'>
      <TemplateButton />
      <CreateAnother />
      <AppAlertDialog
        buttonTitle='Delete Account'
        title='Are you sure?'
        des='Delete hold'
        fn={() => console.log("delete....")}
      />
      <Signout />
    </div>
  )
}

export default Utilities