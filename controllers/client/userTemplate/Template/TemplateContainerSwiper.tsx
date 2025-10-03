// Import Swiper React components
import { Swiper, SwiperSlide } from 'swiper/react';
import { Pagination } from 'swiper/modules';

// Import Swiper styles
import 'swiper/css';
import 'swiper/css/pagination';

import TemplateBack from './TemplateContainer/TemplateBack'
import TemplateFront from './TemplateContainer/TemplateFront'
import apiTemplate from '../api/template';
import useAppEffect from '../../hooks/useAppEffect';
import useAppQuery from '../../hooks/useAppQuery';
import { MyContext } from './templateContext';

const slideCss = `!flex justify-center z-[-1]`

const TemplateContainerSwiper = () => {
  const { error, data, isLoading } = useAppQuery('template_user', apiTemplate.getTemplate);
  useAppEffect(error)

  if(isLoading)
    return <div>Loading...</div>

  return (
    <MyContext.Provider value={{ data }}>
      <Swiper pagination={true} modules={[Pagination]} className="w-full">
          <SwiperSlide className={slideCss}><TemplateFront /></SwiperSlide>
          <SwiperSlide className={slideCss}><TemplateBack /></SwiperSlide>
      </Swiper>
    </MyContext.Provider>
  )
}

export default TemplateContainerSwiper
