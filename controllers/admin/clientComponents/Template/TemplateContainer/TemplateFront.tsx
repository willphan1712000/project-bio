import { QueryClient, QueryClientProvider } from '@tanstack/react-query'
import Template from '../../../../client/userTemplate/Template';

const TemplateFront = () => {
    const queryClient = new QueryClient();
  return (
    <QueryClientProvider client={queryClient}>
      <Template isAdmin={true} />
    </QueryClientProvider>
  )
}

export default TemplateFront
