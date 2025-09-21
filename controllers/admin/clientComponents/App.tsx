import "@radix-ui/themes/styles.css";
import TemplateContainer from './Template/TemplateContainer';
import Utilities from './Utilities/Utilities';
import { MyContext } from "./context";
import { useEffect, useState } from "react";
import { ClipLoader } from "react-spinners";
import handleAsync from "../../client/utilities/handleAsync";
import apiUser, { UserSignin } from './api/user';
import useAppEffect from "../../client/hooks/useAppEffect";
import { Toaster } from "react-hot-toast";

const App = () => {
  const [isLoading, setLoading] = useState(true)
  const [user, setUser] = useState<UserSignin>(undefined)
  const [error, setError] = useState<string>('')

  useAppEffect(error)
  useEffect(() => {
    const handleUserSignin = async () => {
      const {error, data} = await handleAsync(apiUser.getUserSignin())
      if(error) {
        setError(error)
        return
      }
      setLoading(false)
      setUser(data)
    }

    handleUserSignin()
  }, [])

  if(isLoading) {
    return (
      <div className="p-10">
        <ClipLoader />
      </div>
    )
  }

  return (
    <MyContext.Provider value={user}>
      <Toaster />
      <TemplateContainer />
      <Utilities />
    </MyContext.Provider>
  )
}

export default App
