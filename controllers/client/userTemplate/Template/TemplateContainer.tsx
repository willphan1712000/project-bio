import { QueryClient, QueryClientProvider } from '@tanstack/react-query';
import TemplateContainerSwiper from './TemplateContainerSwiper';
import { MyContext } from './context';

/**
 * Entry point for Template
 * @returns TemplateContainer component
 */
interface Props {
  isAdmin?: boolean
}

const TemplateContainer = ({ isAdmin = true }: Props) => {
  const queryClient = new QueryClient();
  
  return (
    <QueryClientProvider client={queryClient}>
      <MyContext.Provider value={{ isAdmin }}>
        <TemplateContainerSwiper />
      </MyContext.Provider>
    </QueryClientProvider>
  )
}

export default TemplateContainer
