
import CreateAnother from './CreateAnother'
import Delete from './Delete/Delete'
import Signout from './Signout'
import TemplateButton from './TemplateButton'

const Utilities = () => {
  return (
    <div className='flex flex-row items-center gap-3'>
      <TemplateButton />
      <CreateAnother />
      <Delete />
      <Signout />
    </div>
  )
}

export default Utilities