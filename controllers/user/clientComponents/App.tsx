import { Toaster } from 'react-hot-toast'
import Template from '../../client/userTemplate/Template'
import { QueryClient, QueryClientProvider } from '@tanstack/react-query'

const App = () => {
  const queryClient = new QueryClient()

  return (
    <QueryClientProvider client={queryClient}>
      <Toaster />
      <Template />
    </QueryClientProvider>
  )
}

export default App
