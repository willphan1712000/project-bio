import { Toaster } from 'react-hot-toast';
import { QueryClient, QueryClientProvider } from '@tanstack/react-query';
import TemplateContainer from '../../client/userTemplate/Template/TemplateContainer';

const App = () => {
    const queryClient = new QueryClient();

    return (
        <QueryClientProvider client={queryClient}>
            <Toaster />
            <TemplateContainer isAdmin={false} />
        </QueryClientProvider>
    );
};

export default App;
