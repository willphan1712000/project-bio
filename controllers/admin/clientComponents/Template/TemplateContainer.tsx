import TemplateBack from './TemplateContainer/TemplateBack'
import TemplateFront from './TemplateContainer/TemplateFront'

const TemplateContainer = () => {
  return (
    <div className='template_container'>
        <TemplateFront />
        <TemplateBack />
    </div>
  )
}

export default TemplateContainer
