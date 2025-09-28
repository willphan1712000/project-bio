import template_dim from '../../../../client/userTemplate/hooks/template_dim'

const TemplateBack = () => {
  const { template_corner, template_height, template_with, template_padding } = template_dim()
  
  return (
    <div style={{
      padding: `${template_padding}px`,
      display: 'flex',
      width: 'fit-content',
      position: 'relative'
    }}>
      <div className='absolute top-[1%] left-[50%] bg-[#fff] rounded-[15px] p-[5px] translate-x-[-50%] z-[99]'>Back</div>
      <div className='flex justify-center items-center bg-white' style={{
        // width: '100%',
        width: `${template_with}px`,
        height: `${template_height}px`,
        borderRadius: `${template_corner}px`
      }}>
        <div>Phan Thanh Nha</div>
      </div>
    </div>
  )
}

export default TemplateBack
