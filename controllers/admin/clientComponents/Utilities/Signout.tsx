import auth from "../../../client/auth/auth"
import AppButton from "../../../client/clientComponents/button/AppButton"

const Signout = () => {
  return (
    <AppButton onClick={() => auth.logout()}>
      <button className="p-[10px]">Sign Out</button>
    </AppButton>
  )
}

export default Signout
