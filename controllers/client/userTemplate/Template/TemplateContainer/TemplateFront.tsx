import Front from './Front';

const TemplateFront = () => {
  return (
    <div className='relative'>
      <div className='absolute top-[1%] left-[50%] bg-[#fff] rounded-[15px] p-[5px] translate-x-[-50%] z-[99]'>Front</div>
      <Front />
    </div>
  )
}

export default TemplateFront
