import TemplateBack from './TemplateContainer/TemplateBack'
import TemplateFront from './TemplateContainer/TemplateFront'
// Import Swiper React components
import { Swiper, SwiperSlide } from 'swiper/react';
import { Pagination } from 'swiper/modules';

// Import Swiper styles
import 'swiper/css';
import 'swiper/css/pagination';
import { QueryClient, QueryClientProvider } from '@tanstack/react-query';

/**
 * Entry point for Template
 * @returns TemplateContainer component
 */
const TemplateContainer = () => {
  const slideCss = `!flex justify-center z-[-1]`
  const queryClient = new QueryClient();
  
  return (
    <QueryClientProvider client={queryClient}>
      <Swiper pagination={true} modules={[Pagination]} className="w-full">
          <SwiperSlide className={slideCss}><TemplateFront /></SwiperSlide>
          <SwiperSlide className={slideCss}><TemplateBack /></SwiperSlide>
      </Swiper>
    </QueryClientProvider>
  )
}

export default TemplateContainer
