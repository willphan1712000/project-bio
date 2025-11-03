import { QueryClient, QueryClientProvider } from '@tanstack/react-query';

// Import Swiper React components
import { Swiper, SwiperSlide } from 'swiper/react';
import { Pagination } from 'swiper/modules';

// Import Swiper styles
import 'swiper/css';
import 'swiper/css/pagination';

import TemplateFront from './TemplateContainer/TemplateFront'
import TemplateBack from './TemplateContainer/Back';
import { MyContext } from './context/context';
import Tools from './Tools/Tools';
import { useState } from 'react';

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
  const [frontTemplateHTML, setFrontTemplateHTML] = useState<HTMLDivElement | undefined>(undefined)
  
  return (
    <QueryClientProvider client={queryClient}>
      <MyContext.Provider value={{ isAdmin, frontTemplateHTML, setFrontTemplateHTML }}>
        <Swiper pagination={true} modules={[Pagination]} className="w-full">
          <SwiperSlide className={slideCss}><TemplateFront /></SwiperSlide>
          <SwiperSlide className={slideCss}><TemplateBack /></SwiperSlide>
        </Swiper>
        { isAdmin && <Tools /> }
      </MyContext.Provider>
    </QueryClientProvider>
  )
}

export default TemplateContainer
