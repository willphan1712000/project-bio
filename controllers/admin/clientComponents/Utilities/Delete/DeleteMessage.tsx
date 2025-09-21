import { useEffect, useRef } from 'react'
import AppButton from '../../../../client/clientComponents/button/AppButton'
import useAppEffect from '../../../../client/hooks/useAppEffect'
import useAppQuery from '../../../../client/hooks/useAppQuery'
import getResource from '../../api/getRources'
import useMyContext from './context'
import DeleteConfirm from './DeleteConfirm'

const DeleteMessage = () => {
  const overlay = useRef<HTMLDivElement>(null)
  const modal = useRef<HTMLDivElement>(null)
  const [state, setState] = useMyContext()
  const { error, data, isLoading } = useAppQuery('delete-message', getResource)
  useAppEffect(error)

  const handleCancelClick = (e: PointerEvent) => {
    if(!modal.current?.contains(e.target as HTMLElement)) {
      setState(prev => ({
        ...prev,
        isDeleteWarningOpen: false
      }))
    }
  }

  useEffect(() => {
    overlay.current?.addEventListener('click', handleCancelClick)

    return () => {
      overlay.current?.removeEventListener('click', handleCancelClick)
    }
  }, [state])

  if(isLoading) return null

  if(state.isDeleteWarningOpen)
    return (
      <div ref={overlay} className='flex justify-center items-center absolute top-0 left-0 bg-[#00000082] h-[100vh] w-[100vw] z-[99]'>
        <div
          ref={modal}
          className='rounded-[30px] bg-white p-[30px] w-[80%] min-w-[300px] max-w-[600px]'
          style={{
            boxShadow: "rgba(149, 157, 165, 0.2) 0px 8px 24px"
          }}  
        >
          <p className='mb-[10px]'>{data?.deleteWarning.msg1}</p>

          <p>{data?.deleteWarning.msg2}</p>
          <p>{data?.deleteWarning.msg3}</p>
          <p className='mt-[10px]'>{data?.deleteWarning.msg4}</p>

          <div className='flex flex-row gap-2 justify-center mt-[10px]'>
            <DeleteConfirm />
            <AppButton
              style={{
                backgroundColor: "#7bed10"
              }}
            >
              <button
              className='p-[10px]'
              onClick={() => setState(prev => ({
                ...prev,
                isDeleteWarningOpen: false
              }))}>Cancel</button>
            </AppButton>
          </div>
        </div>
      </div>
    )
}

export default DeleteMessage
