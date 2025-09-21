import AppButton from "../../../../client/clientComponents/button/AppButton"
import useMyContext from "./context"

const DeleteButton = () => {
  const [,setState] = useMyContext()

  return (
    <AppButton style={{
      backgroundColor: 'red',
      color: '#fff'
    }}
    onClick={() => setState(prev => ({
      ...prev,
      isDeleteWarningOpen: true
    }))}
    >
      <button className="p-[10px]">
        Delete Account
      </button>
    </AppButton>
  )
}

export default DeleteButton
