import Back from './Back'

const TemplateBack = () => {
  return (
    <div style={{
      display: 'flex',
      width: 'fit-content',
      position: 'relative'
    }}>
      <div className='absolute top-[1%] left-[50%] bg-[#fff] rounded-[15px] p-[5px] translate-x-[-50%] z-[99]'>Back</div>
      <Back />
    </div>
  )
}

export default TemplateBack
