import auth from "../../../client/auth/auth"
import AppButton from "../AppButton"

const Signout = () => {
  return (
    <AppButton>
      <button className='' onClick={() => auth.logout()}>
        Sign out
      </button>
    </AppButton>
  )
}

export default Signout
