import React, { useState } from 'react'
import AppButton from '../../../../client/clientComponents/button/AppButton'
import { ClipLoader } from 'react-spinners'
import handleAsync from '../../../../client/utilities/handleAsync'
import apiUser from '../../api/user'
import useMyContext from '../../context'
import useAppEffect from '../../../../client/hooks/useAppEffect'
import auth from '../../../../client/auth/auth'
import config from '../../../../client/config'
import wait from '../../../../client/utilities/wait'
import toast from 'react-hot-toast'
import AppToaster from '../../../../client/clientComponents/AppToaster'

const DeleteConfirm = () => {
  const user = useMyContext()
  const [isDeleting, setDeleting] = useState(false)
  const [error, setError] = useState<string>('')

  useAppEffect(error)

  const handleProceedClick = async (e: React.MouseEvent<HTMLDivElement, MouseEvent>) => {
    e.preventDefault()

    setDeleting(true)
    const { error, data } = await handleAsync(apiUser.deleteUser(user.username))
    if(error) {
      setError(error)
      return
    }

    if(data) {
      setDeleting(false)
      toast(
        <AppToaster
          status={true}
          message='Done, refresh shortly...'
        />
      )
      await wait(2000) // wait 2 seconds

      auth.logout()
      window.location.href = config.routes.signin
    }
  }

  return (
    <AppButton
        style={{
        backgroundColor: "#f0f0f0"
        }}
        onClick={handleProceedClick}
    >
        <button
          disabled={isDeleting}
          className='p-[10px] flex justify-center items-center gap-1'
        >{isDeleting && <ClipLoader size={15}/>} Proceed</button>
    </AppButton>
  )
}

export default DeleteConfirm
