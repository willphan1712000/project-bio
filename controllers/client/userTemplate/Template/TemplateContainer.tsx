import { QueryClient, QueryClientProvider } from '@tanstack/react-query';
import { MyContext } from './context';

// Import Swiper React components
import { Swiper, SwiperSlide } from 'swiper/react';
import { Pagination } from 'swiper/modules';

// Import Swiper styles
import 'swiper/css';
import 'swiper/css/pagination';

import TemplateFront from './TemplateContainer/TemplateFront'
import TemplateBack from './TemplateContainer/Back';

const slideCss = `!flex justify-center z-[-1]`

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
        <Swiper pagination={true} modules={[Pagination]} className="w-full">
          <SwiperSlide className={slideCss}><TemplateFront /></SwiperSlide>
          <SwiperSlide className={slideCss}><TemplateBack /></SwiperSlide>
        </Swiper>
      </MyContext.Provider>
    </QueryClientProvider>
  )
}

export default TemplateContainer
