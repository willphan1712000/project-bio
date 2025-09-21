import { QueryClient, QueryClientProvider } from '@tanstack/react-query'
import DeleteButton from './DeleteButton'
import { Data, MyContext } from './context'
import { useState } from 'react'
import DeleteMessage from './DeleteMessage'

const queryClient = new QueryClient()

/**
 * Detele button - helps put the account on hold for a period of time
 * This component holds a context for the entire delete component
 * @returns 
 */
const Delete = () => {
  const [ state, setState ] = useState<Data>({
    isDeleteWarningOpen: false
  })
  return (
    <QueryClientProvider client={queryClient}>
      <MyContext.Provider value={[state, setState]}>
        <DeleteButton />
        <DeleteMessage />
      </MyContext.Provider>
    </QueryClientProvider>
  )
}

export default Delete
