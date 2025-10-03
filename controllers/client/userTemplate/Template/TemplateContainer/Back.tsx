import template_dim from '../../hooks/template_dim'

const Back = () => {
    const { template_corner, template_height, template_with, template_padding } = template_dim()

  return (
    <div className='flex justify-center items-center bg-white' style={{
        // width: '100%',
        width: `${template_with}px`,
        height: `${template_height}px`,
        borderRadius: `${template_corner}px`,
        padding: `${template_padding}px`
      }}>
        <div>Phan Thanh Nha - Kennesaw State University</div>
    </div>
  )
}

export default Back
