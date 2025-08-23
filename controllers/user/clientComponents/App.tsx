import React from 'react'
import Template from './template/Template'
import { QueryClient, QueryClientProvider } from '@tanstack/react-query'

const App = () => {
  const queryClient = new QueryClient()

  return (
    <QueryClientProvider client={queryClient}>
      <Template />
    </QueryClientProvider>
  )
}

export default App
